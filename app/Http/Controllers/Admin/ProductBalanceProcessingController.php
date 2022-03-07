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
use Yajra\DataTables\Facades\DataTables;

class ProductBalanceProcessingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_balance_processing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductBalanceProcessing::with(['halfproduct', 'balance_min', 'balance_optimal', 'team'])->select(sprintf('%s.*', (new ProductBalanceProcessing())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_balance_processing_show';
                $editGate = 'product_balance_processing_edit';
                $deleteGate = 'product_balance_processing_delete';
                $crudRoutePart = 'product-balance-processings';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('halfproduct_quantity', function ($row) {
                return $row->halfproduct ? $row->halfproduct->quantity : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('balance_min_balance_min', function ($row) {
                return $row->balance_min ? $row->balance_min->balance_min : '';
            });

            $table->addColumn('balance_optimal_balance_optimal', function ($row) {
                return $row->balance_optimal ? $row->balance_optimal->balance_optimal : '';
            });

            $table->editColumn('balance_max', function ($row) {
                return $row->balance_max ? $row->balance_max : '';
            });
            $table->editColumn('balance_reserved', function ($row) {
                return $row->balance_reserved ? $row->balance_reserved : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'halfproduct', 'balance_min', 'balance_optimal']);

            return $table->make(true);
        }

        return view('admin.productBalanceProcessings.index');
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
