<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductPriceRequest;
use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Requests\UpdateProductPriceRequest;
use App\Models\BillMaterial;
use App\Models\ProductPrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductPriceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productPrices = ProductPrice::with(['bom', 'team'])->get();

        return view('admin.productPrices.index', compact('productPrices'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boms = BillMaterial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productPrices.create', compact('boms'));
    }

    public function store(StoreProductPriceRequest $request)
    {
        $productPrice = ProductPrice::create($request->all());

        return redirect()->route('admin.product-prices.index');
    }

    public function edit(ProductPrice $productPrice)
    {
        abort_if(Gate::denies('product_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boms = BillMaterial::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productPrice->load('bom', 'team');

        return view('admin.productPrices.edit', compact('boms', 'productPrice'));
    }

    public function update(UpdateProductPriceRequest $request, ProductPrice $productPrice)
    {
        $productPrice->update($request->all());

        return redirect()->route('admin.product-prices.index');
    }

    public function show(ProductPrice $productPrice)
    {
        abort_if(Gate::denies('product_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productPrice->load('bom', 'team');

        return view('admin.productPrices.show', compact('productPrice'));
    }

    public function destroy(ProductPrice $productPrice)
    {
        abort_if(Gate::denies('product_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productPrice->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductPriceRequest $request)
    {
        ProductPrice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
