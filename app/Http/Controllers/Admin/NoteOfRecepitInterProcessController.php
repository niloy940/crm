<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNoteOfRecepitInterProcessRequest;
use App\Http\Requests\StoreNoteOfRecepitInterProcessRequest;
use App\Http\Requests\UpdateNoteOfRecepitInterProcessRequest;
use App\Models\NoteOfRecepitInterProcess;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use App\Models\User;
use App\Models\WarehousesList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NoteOfRecepitInterProcessController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NoteOfRecepitInterProcess::with(['products', 'int_lot', 'warehouse', 'issuer', 'received_by', 'team'])->select(sprintf('%s.*', (new NoteOfRecepitInterProcess())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'note_of_recepit_inter_process_show';
                $editGate = 'note_of_recepit_inter_process_edit';
                $deleteGate = 'note_of_recepit_inter_process_delete';
                $crudRoutePart = 'note-of-recepit-inter-processes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('product', function ($row) {
                $labels = [];
                foreach ($row->products as $product) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $product->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('int_lot_int_lot', function ($row) {
                return $row->int_lot ? $row->int_lot->int_lot : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('warehouse_name', function ($row) {
                return $row->warehouse ? $row->warehouse->name : '';
            });

            $table->editColumn('shift', function ($row) {
                return $row->shift ? NoteOfRecepitInterProcess::SHIFT_SELECT[$row->shift] : '';
            });

            $table->addColumn('issuer_name', function ($row) {
                return $row->issuer ? $row->issuer->name : '';
            });

            $table->addColumn('received_by_name', function ($row) {
                return $row->received_by ? $row->received_by->name : '';
            });

            $table->editColumn('print', function ($row) {
                return $row->print ? NoteOfRecepitInterProcess::PRINT_SELECT[$row->print] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'int_lot', 'warehouse', 'issuer', 'received_by']);

            return $table->make(true);
        }

        $products_lists   = ProductsList::get();
        $receipt_notes    = ReceiptNote::get();
        $warehouses_lists = WarehousesList::get();
        $users            = User::get();
        $teams            = Team::get();

        return view('admin.noteOfRecepitInterProcesses.index', compact('products_lists', 'receipt_notes', 'warehouses_lists', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $received_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.noteOfRecepitInterProcesses.create', compact('int_lots', 'issuers', 'products', 'received_bies', 'warehouses'));
    }

    public function store(StoreNoteOfRecepitInterProcessRequest $request)
    {
        $noteOfRecepitInterProcess = NoteOfRecepitInterProcess::create($request->all());
        $noteOfRecepitInterProcess->products()->sync($request->input('products', []));

        return redirect()->route('admin.note-of-recepit-inter-processes.index');
    }

    public function edit(NoteOfRecepitInterProcess $noteOfRecepitInterProcess)
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $received_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $noteOfRecepitInterProcess->load('products', 'int_lot', 'warehouse', 'issuer', 'received_by', 'team');

        return view('admin.noteOfRecepitInterProcesses.edit', compact('int_lots', 'issuers', 'noteOfRecepitInterProcess', 'products', 'received_bies', 'warehouses'));
    }

    public function update(UpdateNoteOfRecepitInterProcessRequest $request, NoteOfRecepitInterProcess $noteOfRecepitInterProcess)
    {
        $noteOfRecepitInterProcess->update($request->all());
        $noteOfRecepitInterProcess->products()->sync($request->input('products', []));

        return redirect()->route('admin.note-of-recepit-inter-processes.index');
    }

    public function show(NoteOfRecepitInterProcess $noteOfRecepitInterProcess)
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noteOfRecepitInterProcess->load('products', 'int_lot', 'warehouse', 'issuer', 'received_by', 'team');

        return view('admin.noteOfRecepitInterProcesses.show', compact('noteOfRecepitInterProcess'));
    }

    public function destroy(NoteOfRecepitInterProcess $noteOfRecepitInterProcess)
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noteOfRecepitInterProcess->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoteOfRecepitInterProcessRequest $request)
    {
        NoteOfRecepitInterProcess::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
