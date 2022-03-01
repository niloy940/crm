<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOldestItemRequest;
use App\Http\Requests\StoreOldestItemRequest;
use App\Http\Requests\UpdateOldestItemRequest;
use App\Models\OldestItem;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OldestItemsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('oldest_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OldestItem::with(['product', 'expiry_dates', 'quantity', 'int_lot', 'team'])->select(sprintf('%s.*', (new OldestItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'oldest_item_show';
                $editGate = 'oldest_item_edit';
                $deleteGate = 'oldest_item_delete';
                $crudRoutePart = 'oldest-items';

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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('expiry_date', function ($row) {
                $labels = [];
                foreach ($row->expiry_dates as $expiry_date) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $expiry_date->expiry_date);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('quantity_quantity', function ($row) {
                return $row->quantity ? $row->quantity->quantity : '';
            });

            $table->editColumn('quantity.lot', function ($row) {
                return $row->quantity ? (is_string($row->quantity) ? $row->quantity : $row->quantity->lot) : '';
            });
            $table->addColumn('int_lot_lot', function ($row) {
                return $row->int_lot ? $row->int_lot->lot : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'expiry_date', 'quantity', 'int_lot']);

            return $table->make(true);
        }

        $products_lists = ProductsList::get();
        $receipt_notes  = ReceiptNote::get();
        $teams          = Team::get();

        return view('admin.oldestItems.index', compact('products_lists', 'receipt_notes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('oldest_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.oldestItems.create');
    }

    public function store(StoreOldestItemRequest $request)
    {
        $oldestItem = OldestItem::create($request->all());

        return redirect()->route('admin.oldest-items.index');
    }

    public function edit(OldestItem $oldestItem)
    {
        abort_if(Gate::denies('oldest_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oldestItem->load('product', 'expiry_dates', 'quantity', 'int_lot', 'team');

        return view('admin.oldestItems.edit', compact('oldestItem'));
    }

    public function update(UpdateOldestItemRequest $request, OldestItem $oldestItem)
    {
        $oldestItem->update($request->all());

        return redirect()->route('admin.oldest-items.index');
    }

    public function show(OldestItem $oldestItem)
    {
        abort_if(Gate::denies('oldest_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oldestItem->load('product', 'expiry_dates', 'quantity', 'int_lot', 'team');

        return view('admin.oldestItems.show', compact('oldestItem'));
    }

    public function destroy(OldestItem $oldestItem)
    {
        abort_if(Gate::denies('oldest_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oldestItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyOldestItemRequest $request)
    {
        OldestItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
