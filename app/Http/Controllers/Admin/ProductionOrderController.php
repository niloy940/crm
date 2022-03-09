<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductionOrderRequest;
use App\Http\Requests\StoreProductionOrderRequest;
use App\Http\Requests\UpdateProductionOrderRequest;
use App\Models\CrmCustomer;
use App\Models\ProductionOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductionOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('production_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionOrders = ProductionOrder::with(['client', 'team'])->get();

        return view('admin.productionOrders.index', compact('productionOrders'));
    }

    public function create()
    {
        abort_if(Gate::denies('production_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productionOrders.create', compact('clients'));
    }

    public function store(StoreProductionOrderRequest $request)
    {
        $productionOrder = ProductionOrder::create($request->all());

        return redirect()->route('admin.production-orders.index');
    }

    public function edit(ProductionOrder $productionOrder)
    {
        abort_if(Gate::denies('production_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productionOrder->load('client', 'team');

        return view('admin.productionOrders.edit', compact('clients', 'productionOrder'));
    }

    public function update(UpdateProductionOrderRequest $request, ProductionOrder $productionOrder)
    {
        $productionOrder->update($request->all());

        return redirect()->route('admin.production-orders.index');
    }

    public function show(ProductionOrder $productionOrder)
    {
        abort_if(Gate::denies('production_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionOrder->load('client', 'team');

        return view('admin.productionOrders.show', compact('productionOrder'));
    }

    public function destroy(ProductionOrder $productionOrder)
    {
        abort_if(Gate::denies('production_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productionOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductionOrderRequest $request)
    {
        ProductionOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
