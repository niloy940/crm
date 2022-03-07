<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCreateFinishedProductRequest;
use App\Http\Requests\StoreCreateFinishedProductRequest;
use App\Http\Requests\UpdateCreateFinishedProductRequest;
use App\Models\CreateFinishedProduct;
use App\Models\ProductionSpent;
use App\Models\ProductsList;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CreateFinishedProductController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('create_finished_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CreateFinishedProduct::with(['products', 'user', 'processing_spent', 'team'])->select(sprintf('%s.*', (new CreateFinishedProduct())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'create_finished_product_show';
                $editGate = 'create_finished_product_edit';
                $deleteGate = 'create_finished_product_delete';
                $crudRoutePart = 'create-finished-products';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('shift', function ($row) {
                return $row->shift ? CreateFinishedProduct::SHIFT_SELECT[$row->shift] : '';
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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('processing_spent_name', function ($row) {
                return $row->processing_spent ? $row->processing_spent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'user', 'processing_spent']);

            return $table->make(true);
        }

        return view('admin.createFinishedProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_finished_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $processing_spents = ProductionSpent::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.createFinishedProducts.create', compact('processing_spents', 'products', 'users'));
    }

    public function store(StoreCreateFinishedProductRequest $request)
    {
        $createFinishedProduct = CreateFinishedProduct::create($request->all());
        $createFinishedProduct->products()->sync($request->input('products', []));

        return redirect()->route('admin.create-finished-products.index');
    }

    public function edit(CreateFinishedProduct $createFinishedProduct)
    {
        abort_if(Gate::denies('create_finished_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsList::pluck('name', 'id');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $processing_spents = ProductionSpent::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $createFinishedProduct->load('products', 'user', 'processing_spent', 'team');

        return view('admin.createFinishedProducts.edit', compact('createFinishedProduct', 'processing_spents', 'products', 'users'));
    }

    public function update(UpdateCreateFinishedProductRequest $request, CreateFinishedProduct $createFinishedProduct)
    {
        $createFinishedProduct->update($request->all());
        $createFinishedProduct->products()->sync($request->input('products', []));

        return redirect()->route('admin.create-finished-products.index');
    }

    public function show(CreateFinishedProduct $createFinishedProduct)
    {
        abort_if(Gate::denies('create_finished_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $createFinishedProduct->load('products', 'user', 'processing_spent', 'team');

        return view('admin.createFinishedProducts.show', compact('createFinishedProduct'));
    }

    public function destroy(CreateFinishedProduct $createFinishedProduct)
    {
        abort_if(Gate::denies('create_finished_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $createFinishedProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyCreateFinishedProductRequest $request)
    {
        CreateFinishedProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
