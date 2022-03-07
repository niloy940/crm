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
use Yajra\DataTables\Facades\DataTables;

class BillMaterialsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillMaterial::with(['for_product', 'ingridients', 'team'])->select(sprintf('%s.*', (new BillMaterial())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_material_show';
                $editGate = 'bill_material_edit';
                $deleteGate = 'bill_material_delete';
                $crudRoutePart = 'bill-materials';

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
            $table->addColumn('for_product_name', function ($row) {
                return $row->for_product ? $row->for_product->name : '';
            });

            $table->editColumn('for_product.price', function ($row) {
                return $row->for_product ? (is_string($row->for_product) ? $row->for_product : $row->for_product->price) : '';
            });
            $table->editColumn('ingridients', function ($row) {
                $labels = [];
                foreach ($row->ingridients as $ingridient) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $ingridient->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('coefficient', function ($row) {
                return $row->coefficient ? $row->coefficient : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'for_product', 'ingridients']);

            return $table->make(true);
        }

        return view('admin.billMaterials.index');
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
