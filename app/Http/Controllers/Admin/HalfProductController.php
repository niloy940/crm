<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHalfProductRequest;
use App\Http\Requests\StoreHalfProductRequest;
use App\Http\Requests\UpdateHalfProductRequest;
use App\Models\HalfProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HalfProductController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('half_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HalfProduct::with(['team'])->select(sprintf('%s.*', (new HalfProduct())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'half_product_show';
                $editGate = 'half_product_edit';
                $deleteGate = 'half_product_delete';
                $crudRoutePart = 'half-products';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.halfProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('half_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.halfProducts.create');
    }

    public function store(StoreHalfProductRequest $request)
    {
        $halfProduct = HalfProduct::create($request->all());

        return redirect()->route('admin.half-products.index');
    }

    public function edit(HalfProduct $halfProduct)
    {
        abort_if(Gate::denies('half_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProduct->load('team');

        return view('admin.halfProducts.edit', compact('halfProduct'));
    }

    public function update(UpdateHalfProductRequest $request, HalfProduct $halfProduct)
    {
        $halfProduct->update($request->all());

        return redirect()->route('admin.half-products.index');
    }

    public function show(HalfProduct $halfProduct)
    {
        abort_if(Gate::denies('half_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProduct->load('team');

        return view('admin.halfProducts.show', compact('halfProduct'));
    }

    public function destroy(HalfProduct $halfProduct)
    {
        abort_if(Gate::denies('half_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyHalfProductRequest $request)
    {
        HalfProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
