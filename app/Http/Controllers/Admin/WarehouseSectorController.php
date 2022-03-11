<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWarehouseSectorRequest;
use App\Http\Requests\StoreWarehouseSectorRequest;
use App\Http\Requests\UpdateWarehouseSectorRequest;
use App\Models\WarehouseSector;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarehouseSectorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('warehouse_sector_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouseSectors = WarehouseSector::all();

        return view('admin.warehouseSectors.index', compact('warehouseSectors'));
    }

    public function create()
    {
        abort_if(Gate::denies('warehouse_sector_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.warehouseSectors.create');
    }

    public function store(StoreWarehouseSectorRequest $request)
    {
        $warehouseSector = WarehouseSector::create($request->all());

        return redirect()->route('admin.warehouse-sectors.index');
    }

    public function edit(WarehouseSector $warehouseSector)
    {
        abort_if(Gate::denies('warehouse_sector_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.warehouseSectors.edit', compact('warehouseSector'));
    }

    public function update(UpdateWarehouseSectorRequest $request, WarehouseSector $warehouseSector)
    {
        $warehouseSector->update($request->all());

        return redirect()->route('admin.warehouse-sectors.index');
    }

    public function show(WarehouseSector $warehouseSector)
    {
        abort_if(Gate::denies('warehouse_sector_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.warehouseSectors.show', compact('warehouseSector'));
    }

    public function destroy(WarehouseSector $warehouseSector)
    {
        abort_if(Gate::denies('warehouse_sector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warehouseSector->delete();

        return back();
    }

    public function massDestroy(MassDestroyWarehouseSectorRequest $request)
    {
        WarehouseSector::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
