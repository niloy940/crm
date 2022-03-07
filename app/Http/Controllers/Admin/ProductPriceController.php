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
use Yajra\DataTables\Facades\DataTables;

class ProductPriceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductPrice::with(['bom', 'team'])->select(sprintf('%s.*', (new ProductPrice())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_price_show';
                $editGate = 'product_price_edit';
                $deleteGate = 'product_price_delete';
                $crudRoutePart = 'product-prices';

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
            $table->addColumn('bom_name', function ($row) {
                return $row->bom ? $row->bom->name : '';
            });

            $table->editColumn('bom.total', function ($row) {
                return $row->bom ? (is_string($row->bom) ? $row->bom : $row->bom->total) : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bom']);

            return $table->make(true);
        }

        return view('admin.productPrices.index');
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
