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

class HalfProductMakeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('half_product_make_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $halfProductMakes = HalfProductMake::with(['halfproduct', 'ingridients', 'int_lots', 'made_by'])->get();

        $half_products = HalfProduct::get();

        $products_lists = ProductsList::get();

        $receipt_notes = ReceiptNote::get();

        $users = User::get();

        return view('admin.halfProductMakes.index', compact('halfProductMakes', 'half_products', 'products_lists', 'receipt_notes', 'users'));
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
