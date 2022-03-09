<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBillMaterialRequest;
use App\Http\Requests\StoreBillMaterialRequest;
use App\Http\Requests\UpdateBillMaterialRequest;
use App\Models\BillMaterial;
use App\Models\ProductsList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillMaterialsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billMaterials = BillMaterial::with(['for_product', 'ingridients', 'team'])->get();

        return view('admin.billMaterials.index', compact('billMaterials'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_material_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ingridients = ProductsList::pluck('name', 'id');

        return view('admin.billMaterials.create', compact('for_products', 'ingridients'));
    }

    public function store(StoreBillMaterialRequest $request)
    {
        $billMaterial = BillMaterial::create($request->all());
        $billMaterial->ingridients()->sync($request->input('ingridients', []));

        return redirect()->route('admin.bill-materials.index');
    }

    public function edit(BillMaterial $billMaterial)
    {
        abort_if(Gate::denies('bill_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ingridients = ProductsList::pluck('name', 'id');

        $billMaterial->load('for_product', 'ingridients', 'team');

        return view('admin.billMaterials.edit', compact('billMaterial', 'for_products', 'ingridients'));
    }

    public function update(UpdateBillMaterialRequest $request, BillMaterial $billMaterial)
    {
        $billMaterial->update($request->all());
        $billMaterial->ingridients()->sync($request->input('ingridients', []));

        return redirect()->route('admin.bill-materials.index');
    }

    public function show(BillMaterial $billMaterial)
    {
        abort_if(Gate::denies('bill_material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billMaterial->load('for_product', 'ingridients', 'team');

        return view('admin.billMaterials.show', compact('billMaterial'));
    }

    public function destroy(BillMaterial $billMaterial)
    {
        abort_if(Gate::denies('bill_material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billMaterial->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillMaterialRequest $request)
    {
        BillMaterial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
