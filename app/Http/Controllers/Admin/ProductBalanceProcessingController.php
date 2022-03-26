<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductBalanceProcessingRequest;
use App\Http\Requests\StoreProductBalanceProcessingRequest;
use App\Http\Requests\UpdateProductBalanceProcessingRequest;
use App\Models\HalfProductMake;
use App\Models\ProductBalanceProcessing;
use App\Models\ProductsList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBalanceProcessingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_balance_processing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalanceProcessings = ProductBalanceProcessing::with(['halfproduct', 'balance_min', 'balance_optimal', 'team'])->get();

        $half_product_makes = HalfProductMake::all();

        return view('admin.productBalanceProcessings.index', compact('productBalanceProcessings', 'half_product_makes'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_balance_processing_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfproducts = HalfProductMake::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_mins = ProductsList::pluck('balance_min', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_optimals = ProductsList::pluck('balance_optimal', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productBalanceProcessings.create', compact('balance_mins', 'balance_optimals', 'halfproducts'));
    }

    public function store(StoreProductBalanceProcessingRequest $request)
    {
        $productBalanceProcessing = ProductBalanceProcessing::create($request->all());

        return redirect()->route('admin.product-balance-processings.index');
    }

    public function edit(ProductBalanceProcessing $productBalanceProcessing)
    {
        abort_if(Gate::denies('product_balance_processing_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfproducts = HalfProductMake::pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_mins = ProductsList::pluck('balance_min', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_optimals = ProductsList::pluck('balance_optimal', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productBalanceProcessing->load('halfproduct', 'balance_min', 'balance_optimal', 'team');

        return view('admin.productBalanceProcessings.edit', compact('balance_mins', 'balance_optimals', 'halfproducts', 'productBalanceProcessing'));
    }

    public function update(UpdateProductBalanceProcessingRequest $request, ProductBalanceProcessing $productBalanceProcessing)
    {
        $productBalanceProcessing->update($request->all());

        return redirect()->route('admin.product-balance-processings.index');
    }

    public function show(ProductBalanceProcessing $productBalanceProcessing)
    {
        abort_if(Gate::denies('product_balance_processing_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalanceProcessing->load('halfproduct', 'balance_min', 'balance_optimal', 'team');

        return view('admin.productBalanceProcessings.show', compact('productBalanceProcessing'));
    }

    public function destroy(ProductBalanceProcessing $productBalanceProcessing)
    {
        abort_if(Gate::denies('product_balance_processing_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalanceProcessing->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductBalanceProcessingRequest $request)
    {
        ProductBalanceProcessing::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
