<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHalfProductMakeRequest;
use App\Http\Requests\StoreHalfProductMakeRequest;
use App\Http\Requests\UpdateHalfProductMakeRequest;
use App\Models\HalfProduct;
use App\Models\HalfProductMake;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HalfProductMakeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('half_product_make_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HalfProductMake::with(['halfproduct', 'ingridients', 'int_lots', 'made_by'])->select(sprintf('%s.*', (new HalfProductMake())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'half_product_make_show';
                $editGate = 'half_product_make_edit';
                $deleteGate = 'half_product_make_delete';
                $crudRoutePart = 'half-product-makes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('halfproduct_name', function ($row) {
                return $row->halfproduct ? $row->halfproduct->name : '';
            });

            $table->editColumn('ingridients', function ($row) {
                $labels = [];
                foreach ($row->ingridients as $ingridient) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $ingridient->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('int_lot', function ($row) {
                $labels = [];
                foreach ($row->int_lots as $int_lot) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $int_lot->int_lot);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('made_by_name', function ($row) {
                return $row->made_by ? $row->made_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'halfproduct', 'ingridients', 'int_lot', 'made_by']);

            return $table->make(true);
        }

        $half_products  = HalfProduct::get();
        $products_lists = ProductsList::get();
        $receipt_notes  = ReceiptNote::get();
        $users          = User::get();

        return view('admin.halfProductMakes.index', compact('half_products', 'products_lists', 'receipt_notes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('half_product_make_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfproducts = HalfProduct::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ingridients = ProductsList::pluck('name', 'id');

        $int_lots = ReceiptNote::pluck('int_lot', 'id');

        $made_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.halfProductMakes.create', compact('halfproducts', 'ingridients', 'int_lots', 'made_bies'));
    }

    public function store(StoreHalfProductMakeRequest $request)
    {
        $halfProductMake = HalfProductMake::create($request->all());
        $halfProductMake->ingridients()->sync($request->input('ingridients', []));
        $halfProductMake->int_lots()->sync($request->input('int_lots', []));

        return redirect()->route('admin.half-product-makes.index');
    }

    public function edit(HalfProductMake $halfProductMake)
    {
        abort_if(Gate::denies('half_product_make_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfproducts = HalfProduct::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ingridients = ProductsList::pluck('name', 'id');

        $int_lots = ReceiptNote::pluck('int_lot', 'id');

        $made_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $halfProductMake->load('halfproduct', 'ingridients', 'int_lots', 'made_by');

        return view('admin.halfProductMakes.edit', compact('halfProductMake', 'halfproducts', 'ingridients', 'int_lots', 'made_bies'));
    }

    public function update(UpdateHalfProductMakeRequest $request, HalfProductMake $halfProductMake)
    {
        $halfProductMake->update($request->all());
        $halfProductMake->ingridients()->sync($request->input('ingridients', []));
        $halfProductMake->int_lots()->sync($request->input('int_lots', []));

        return redirect()->route('admin.half-product-makes.index');
    }

    public function show(HalfProductMake $halfProductMake)
    {
        abort_if(Gate::denies('half_product_make_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProductMake->load('halfproduct', 'ingridients', 'int_lots', 'made_by');

        return view('admin.halfProductMakes.show', compact('halfProductMake'));
    }

    public function destroy(HalfProductMake $halfProductMake)
    {
        abort_if(Gate::denies('half_product_make_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProductMake->delete();

        return back();
    }

    public function massDestroy(MassDestroyHalfProductMakeRequest $request)
    {
        HalfProductMake::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
