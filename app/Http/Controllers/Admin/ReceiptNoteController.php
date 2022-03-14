<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReceiptNoteRequest;
use App\Http\Requests\StoreReceiptNoteRequest;
use App\Http\Requests\UpdateReceiptNoteRequest;
use App\Models\CrmCustomer;
use App\Models\ProductBalance;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use App\Models\WarehousesList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReceiptNoteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('receipt_note_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReceiptNote::with(['client', 'products', 'warehouse', 'team'])->select(sprintf('%s.*', (new ReceiptNote())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'receipt_note_show';
                $editGate = 'receipt_note_edit';
                $deleteGate = 'receipt_note_delete';
                $crudRoutePart = 'receipt-notes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_company_name', function ($row) {
                return $row->client ? $row->client->company_name : '';
            });

            $table->editColumn('client.email', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->email) : '';
            });
            $table->editColumn('client.phone', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->phone) : '';
            });
            $table->editColumn('client.address', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->address) : '';
            });
            $table->editColumn('client.tax_no', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->tax_no) : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('int_lot', function ($row) {
                return $row->int_lot ? $row->int_lot : '';
            });
            $table->addColumn('warehouse_name', function ($row) {
                return $row->warehouse ? $row->warehouse->name : '';
            });

            $table->editColumn('shift', function ($row) {
                return $row->shift ? ReceiptNote::SHIFT_SELECT[$row->shift] : '';
            });

            $table->editColumn('print', function ($row) {
                return $row->print ? ReceiptNote::PRINT_SELECT[$row->print] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'warehouse']);

            return $table->make(true);
        }

        $crm_customers    = CrmCustomer::get();
        $products_lists   = ProductsList::get();
        $warehouses_lists = WarehousesList::get();
        $teams            = Team::get();

        return view('admin.receiptNotes.index', compact('crm_customers', 'products_lists', 'warehouses_lists', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('receipt_note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $int_lot = uniqid().date('Ymd');

        return view('admin.receiptNotes.create', compact('clients', 'products', 'warehouses', 'int_lot'));
    }

    public function store(StoreReceiptNoteRequest $request)
    {
        $receiptNote = ReceiptNote::create($request->all());
        // $receiptNote->products()->sync($request->input('products', []));

        $product_balance = ProductBalance::create();

        $product_balance->names()->sync($request->products);
        
        for ($i=0; $i < count($request->products); $i++) {
            $receiptNote->products()->attach($request->products[$i], ['quantity' => $request->quantities[$i]]);
        }


        return redirect()->route('admin.receipt-notes.index');
    }

    public function edit(ReceiptNote $receiptNote)
    {
        abort_if(Gate::denies('receipt_note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receiptNote->load('client', 'products', 'warehouse', 'team');

        return view('admin.receiptNotes.edit', compact('products', 'receiptNote', 'warehouses'));
    }

    public function update(UpdateReceiptNoteRequest $request, ReceiptNote $receiptNote)
    {
        $receiptNote->update($request->all());
        $receiptNote->products()->sync($request->input('products', []));

        return redirect()->route('admin.receipt-notes.index');
    }

    public function show(ReceiptNote $receiptNote)
    {
        abort_if(Gate::denies('receipt_note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receiptNote->load('client', 'products', 'warehouse', 'team');

        return view('admin.receiptNotes.show', compact('receiptNote'));
    }

    public function destroy(ReceiptNote $receiptNote)
    {
        abort_if(Gate::denies('receipt_note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receiptNote->delete();

        return back();
    }

    public function massDestroy(MassDestroyReceiptNoteRequest $request)
    {
        ReceiptNote::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
