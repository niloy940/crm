<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReceiptNoteRequest;
use App\Http\Requests\StoreReceiptNoteRequest;
use App\Http\Requests\UpdateReceiptNoteRequest;
use App\Models\CrmCustomer;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use App\Models\User;
use App\Models\WarehouseSector;
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
            $query = ReceiptNote::with(['client', 'products', 'warehouse', 'sector', 'issuer', 'team'])->select(sprintf('%s.*', (new ReceiptNote())->table));
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

            $table->addColumn('sector_name', function ($row) {
                return $row->sector ? $row->sector->name : '';
            });

            $table->editColumn('shelf', function ($row) {
                return $row->shelf ? $row->shelf : '';
            });
            $table->editColumn('shift', function ($row) {
                return $row->shift ? ReceiptNote::SHIFT_SELECT[$row->shift] : '';
            });

            $table->editColumn('print', function ($row) {
                return $row->print ? ReceiptNote::PRINT_SELECT[$row->print] : '';
            });
            $table->addColumn('issuer_name', function ($row) {
                return $row->issuer ? $row->issuer->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'warehouse', 'sector', 'issuer']);

            return $table->make(true);
        }

        $crm_customers     = CrmCustomer::get();
        $products_lists    = ProductsList::get();
        $warehouses_lists  = WarehousesList::get();
        $warehouse_sectors = WarehouseSector::get();
        $users             = User::get();
        $teams             = Team::get();

        return view('admin.receiptNotes.index', compact('crm_customers', 'products_lists', 'warehouses_lists', 'warehouse_sectors', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('receipt_note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sectors = WarehouseSector::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.receiptNotes.create', compact('clients', 'issuers', 'products', 'sectors', 'warehouses'));
    }

    public function store(StoreReceiptNoteRequest $request)
    {
        $receiptNote = ReceiptNote::create($request->all());
        $receiptNote->products()->sync($request->input('products', []));

        return redirect()->route('admin.receipt-notes.index');
    }

    public function edit(ReceiptNote $receiptNote)
    {
        abort_if(Gate::denies('receipt_note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sectors = WarehouseSector::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receiptNote->load('client', 'products', 'warehouse', 'sector', 'issuer', 'team');

        return view('admin.receiptNotes.edit', compact('issuers', 'products', 'receiptNote', 'sectors', 'warehouses'));
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

        $receiptNote->load('client', 'products', 'warehouse', 'sector', 'issuer', 'team');

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
