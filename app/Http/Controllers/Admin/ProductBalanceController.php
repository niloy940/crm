<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductBalanceRequest;
use App\Http\Requests\StoreProductBalanceRequest;
use App\Http\Requests\UpdateProductBalanceRequest;
use App\Models\ProductBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductBalanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('product_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductBalance::with(['names', 'team', 'balance_optimal', 'balance_min'])->select(sprintf('%s.*', (new ProductBalance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_balance_show';
                $editGate = 'product_balance_edit';
                $deleteGate = 'product_balance_delete';
                $crudRoutePart = 'product-balances';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('name', function ($row) {
                $labels = [];
                foreach ($row->names as $name) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $name->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('balance_optimal_balance_optimal', function ($row) {
                return $row->balance_optimal ? $row->balance_optimal->balance_optimal : '';
            });

            $table->addColumn('balance_min_balance_min', function ($row) {
                return $row->balance_min ? $row->balance_min->balance_min : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name', 'balance_optimal', 'balance_min']);

            return $table->make(true);
        }

        return view('admin.productBalances.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_balance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productBalances.create');
    }

    public function store(StoreProductBalanceRequest $request)
    {
        $productBalance = ProductBalance::create($request->all());

        return redirect()->route('admin.product-balances.index');
    }

    public function edit(ProductBalance $productBalance)
    {
        abort_if(Gate::denies('product_balance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalance->load('names', 'team', 'balance_optimal', 'balance_min');

        return view('admin.productBalances.edit', compact('productBalance'));
    }

    public function update(UpdateProductBalanceRequest $request, ProductBalance $productBalance)
    {
        $productBalance->update($request->all());

        return redirect()->route('admin.product-balances.index');
    }

    public function show(ProductBalance $productBalance)
    {
        abort_if(Gate::denies('product_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productBalance->load('names', 'team', 'balance_optimal', 'balance_min');

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
