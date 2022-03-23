<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWarehouseTransferRequest;
use App\Http\Requests\StoreWarehouseTransferRequest;
use App\Http\Requests\UpdateWarehouseTransferRequest;
use App\Models\InternalLot;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use App\Models\User;
use App\Models\WarehousesList;
use App\Models\WarehouseTransfer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WarehouseTransferController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('warehouse_transfer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WarehouseTransfer::with(['warehouse_from', 'warehouse_to', 'products', 'internalLots', 'user', 'user_received', 'team'])->select(sprintf('%s.*', (new WarehouseTransfer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'warehouse_transfer_show';
                $editGate = 'warehouse_transfer_edit';
                $deleteGate = 'warehouse_transfer_delete';
                $crudRoutePart = 'warehouse-transfers';

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
            $table->addColumn('warehouse_from_name', function ($row) {
                return $row->warehouse_from ? $row->warehouse_from->name : '';
            });

            $table->addColumn('warehouse_to_name', function ($row) {
                return $row->warehouse_to ? $row->warehouse_to->name : '';
            });

            $table->addColumn('product_name', function ($row) {
                $labels = [];
                foreach ($row->products as $product) {
                    $labels[] = $product->name;
                }

                return implode(' , ', $labels);
            });

            $table->addColumn('int_lot_int_lot', function ($row) {
                $labels = [];
                foreach ($row->internalLots as $internal_lot) {
                    $labels[] = $internal_lot->int_lot;
                }

                return implode(' ', $labels);
            });

            $table->editColumn('quantity', function ($row) {
                $labels = [];
                foreach ($row->internalLots as $internal_lot) {
                    $labels[] = $internal_lot->pivot->reserved_quantity;
                }

                return implode(' , ', $labels);
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('user_received_name', function ($row) {
                return $row->user_received ? $row->user_received->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'warehouse_from', 'warehouse_to', 'product', 'int_lot', 'user', 'user_received']);

            return $table->make(true);
        }

        $warehouses_lists = WarehousesList::get();
        $products_lists   = ProductsList::get();
        $receipt_notes    = ReceiptNote::get();
        $users            = User::get();
        $teams            = Team::get();

        return view('admin.warehouseTransfers.index', compact('warehouses_lists', 'products_lists', 'receipt_notes', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('warehouse_transfer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouse_froms = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warehouse_tos = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $int_lots = InternalLot::all();

        // $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user = auth()->user();

        $user_receiveds = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.warehouseTransfers.create', compact('int_lots', 'products', 'user_receiveds', 'user', 'warehouse_froms', 'warehouse_tos'));
    }

    public function store(StoreWarehouseTransferRequest $request)
    {
        $warehouseTransfer = WarehouseTransfer::create($request->all());

        $warehouseTransfer->products()->sync($request->products);

        for ($i=0; $i < count($request->products); $i++) {
            $warehouseTransfer->internalLots()
                ->attach($request->int_lots[$i], ['reserved_quantity' => $request->quantities[$i]]);

            $internalLot = InternalLot::where('id', $request->int_lots[$i])->first();
            
            $quantity = $internalLot->quantity - $request->quantities[$i];
            $reserved_quantity = $internalLot->reserved_quantity + $request->quantities[$i];
            
            $internalLot->update(
                [
                    'quantity' => $quantity,
                    'reserved_quantity' => $reserved_quantity
                ]
            );
        }

        return redirect()->route('admin.warehouse-transfers.index');
    }

    public function edit(WarehouseTransfer $warehouseTransfer)
    {
        abort_if(Gate::denies('warehouse_transfer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouse_froms = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warehouse_tos = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warehouseTransfer->load('warehouse_from', 'warehouse_to', 'products', 'internalLots', 'user', 'user_received', 'team');

        return view('admin.warehouseTransfers.edit', compact('int_lots', 'warehouseTransfer', 'warehouse_froms', 'warehouse_tos'));
    }

    public function update(UpdateWarehouseTransferRequest $request, WarehouseTransfer $warehouseTransfer)
    {
        $warehouseTransfer->update($request->all());

        return redirect()->route('admin.warehouse-transfers.index');
    }

    public function show(WarehouseTransfer $warehouseTransfer)
    {
        abort_if(Gate::denies('warehouse_transfer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouseTransfer->load('warehouse_from', 'warehouse_to', 'products', 'internalLots', 'user', 'user_received', 'team');

        return view('admin.warehouseTransfers.show', compact('warehouseTransfer'));
    }

    public function destroy(WarehouseTransfer $warehouseTransfer)
    {
        abort_if(Gate::denies('warehouse_transfer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouseTransfer->delete();

        return back();
    }

    public function massDestroy(MassDestroyWarehouseTransferRequest $request)
    {
        WarehouseTransfer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
