<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWarehousesListRequest;
use App\Http\Requests\StoreWarehousesListRequest;
use App\Http\Requests\UpdateWarehousesListRequest;
use App\Models\WarehousesList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarehousesListController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('warehouses_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehousesLists = WarehousesList::with(['team'])->get();

        return view('admin.warehousesLists.index', compact('warehousesLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('warehouses_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.warehousesLists.create');
    }

    public function store(StoreWarehousesListRequest $request)
    {
        $warehousesList = WarehousesList::create($request->all());

        return redirect()->route('admin.warehouses-lists.index');
    }

    public function edit(WarehousesList $warehousesList)
    {
        abort_if(Gate::denies('warehouses_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehousesList->load('team');

        return view('admin.warehousesLists.edit', compact('warehousesList'));
    }

    public function update(UpdateWarehousesListRequest $request, WarehousesList $warehousesList)
    {
        $warehousesList->update($request->all());

        return redirect()->route('admin.warehouses-lists.index');
    }

    public function show(WarehousesList $warehousesList)
    {
        abort_if(Gate::denies('warehouses_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehousesList->load('team');

        return view('admin.warehousesLists.show', compact('warehousesList'));
    }

    public function destroy(WarehousesList $warehousesList)
    {
        abort_if(Gate::denies('warehouses_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehousesList->delete();

        return back();
    }

    public function massDestroy(MassDestroyWarehousesListRequest $request)
    {
        WarehousesList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
