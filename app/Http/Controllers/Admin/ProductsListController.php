<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductsListRequest;
use App\Http\Requests\StoreProductsListRequest;
use App\Http\Requests\UpdateProductsListRequest;
use App\Models\ProductsList;
use App\Models\WarehousesList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsListController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('products_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsLists = ProductsList::with(['warehouse', 'int_lots', 'team'])->get();

        return view('admin.productsLists.index', compact('productsLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('products_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productsLists.create', compact('warehouses'));
    }

    public function store(StoreProductsListRequest $request)
    {
        $productsList = ProductsList::create($request->all());

        return redirect()->route('admin.products-lists.index');
    }

    public function edit(ProductsList $productsList)
    {
        abort_if(Gate::denies('products_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouses = WarehousesList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productsList->load('warehouse', 'int_lots', 'team');

        return view('admin.productsLists.edit', compact('productsList', 'warehouses'));
    }

    public function update(UpdateProductsListRequest $request, ProductsList $productsList)
    {
        $productsList->update($request->all());

        return redirect()->route('admin.products-lists.index');
    }

    public function show(ProductsList $productsList)
    {
        abort_if(Gate::denies('products_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsList->load('warehouse', 'int_lots', 'team');

        return view('admin.productsLists.show', compact('productsList'));
    }

    public function destroy(ProductsList $productsList)
    {
        abort_if(Gate::denies('products_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productsList->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductsListRequest $request)
    {
        ProductsList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
