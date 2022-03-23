<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductBalanceRequest;
use App\Http\Requests\StoreProductBalanceRequest;
use App\Http\Requests\UpdateProductBalanceRequest;
use App\Models\ProductBalance;
use App\Models\ProductsList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductBalanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalances = ProductBalance::with(['productLists', 'team', 'balance_optimal', 'balance_min'])->get();

        $products = ProductsList::all();

        return view('admin.productBalances.index', compact(['productBalances', 'products']));
    }

    public function create()
    {
        abort_if(Gate::denies('product_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $balance_optimals = ProductsList::pluck('balance_optimal', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_mins = ProductsList::pluck('balance_min', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productBalances.create', compact('balance_mins', 'balance_optimals'));
    }

    public function store(StoreProductBalanceRequest $request)
    {
        $productBalance = ProductBalance::create($request->all());

        return redirect()->route('admin.product-balances.index');
    }

    public function edit(ProductBalance $productBalance)
    {
        abort_if(Gate::denies('product_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $balance_optimals = ProductsList::pluck('balance_optimal', 'id')->prepend(trans('global.pleaseSelect'), '');

        $balance_mins = ProductsList::pluck('balance_min', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productBalance->load('productLists', 'team', 'balance_optimal', 'balance_min');

        return view('admin.productBalances.edit', compact('balance_mins', 'balance_optimals', 'productBalance'));
    }

    public function update(UpdateProductBalanceRequest $request, ProductBalance $productBalance)
    {
        $productBalance->update($request->all());

        return redirect()->route('admin.product-balances.index');
    }

    public function show(ProductBalance $productBalance)
    {
        abort_if(Gate::denies('product_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalance->load('productLists', 'team', 'balance_optimal', 'balance_min');

        return view('admin.productBalances.show', compact('productBalance'));
    }

    public function destroy(ProductBalance $productBalance)
    {
        abort_if(Gate::denies('product_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalance->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductBalanceRequest $request)
    {
        ProductBalance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
