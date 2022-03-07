<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductionSpentRequest;
use App\Http\Requests\StoreProductionSpentRequest;
use App\Http\Requests\UpdateProductionSpentRequest;
use App\Models\ProductionSpent;
use App\Models\ProductsList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductionSpentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('production_spent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductionSpent::with(['products', 'ingridients', 'team'])->select(sprintf('%s.*', (new ProductionSpent())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'production_spent_show';
                $editGate = 'production_spent_edit';
                $deleteGate = 'production_spent_delete';
                $crudRoutePart = 'production-spents';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('product', function ($row) {
                $labels = [];
                foreach ($row->products as $product) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $product->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('shift', function ($row) {
                return $row->shift ? ProductionSpent::SHIFT_SELECT[$row->shift] : '';
            });

            $table->addColumn('ingridients_name', function ($row) {
                return $row->ingridients ? $row->ingridients->name : '';
            });

            $table->editColumn('quantity_ing', function ($row) {
                return $row->quantity_ing ? $row->quantity_ing : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'ingridients']);

            return $table->make(true);
        }

        return view('admin.productionSpents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('production_spent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $ingridients = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productionSpents.create', compact('ingridients', 'products'));
    }

    public function store(StoreProductionSpentRequest $request)
    {
        $productionSpent = ProductionSpent::create($request->all());
        $productionSpent->products()->sync($request->input('products', []));

        return redirect()->route('admin.production-spents.index');
    }

    public function edit(ProductionSpent $productionSpent)
    {
        abort_if(Gate::denies('production_spent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $ingridients = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productionSpent->load('products', 'ingridients', 'team');

        return view('admin.productionSpents.edit', compact('ingridients', 'productionSpent', 'products'));
    }

    public function update(UpdateProductionSpentRequest $request, ProductionSpent $productionSpent)
    {
        $productionSpent->update($request->all());
        $productionSpent->products()->sync($request->input('products', []));

        return redirect()->route('admin.production-spents.index');
    }

    public function show(ProductionSpent $productionSpent)
    {
        abort_if(Gate::denies('production_spent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionSpent->load('products', 'ingridients', 'team');

        return view('admin.productionSpents.show', compact('productionSpent'));
    }

    public function destroy(ProductionSpent $productionSpent)
    {
        abort_if(Gate::denies('production_spent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionSpent->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductionSpentRequest $request)
    {
        ProductionSpent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
