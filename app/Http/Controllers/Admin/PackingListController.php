<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPackingListRequest;
use App\Http\Requests\StorePackingListRequest;
use App\Http\Requests\UpdatePackingListRequest;
use App\Models\CrmCustomer;
use App\Models\PackingList;
use App\Models\ProductsList;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PackingListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('packing_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PackingList::with(['client', 'product', 'user', 'team'])->select(sprintf('%s.*', (new PackingList())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'packing_list_show';
                $editGate = 'packing_list_edit';
                $deleteGate = 'packing_list_delete';
                $crudRoutePart = 'packing-lists';

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
            $table->addColumn('client_company_name', function ($row) {
                return $row->client ? $row->client->company_name : '';
            });

            $table->editColumn('client.email', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->email) : '';
            });
            $table->editColumn('client.phone', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->phone) : '';
            });
            $table->editColumn('client.address', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->address) : '';
            });
            $table->editColumn('client.tax_no', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->tax_no) : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('net_weight', function ($row) {
                return $row->net_weight ? $row->net_weight : '';
            });
            $table->editColumn('bruto_weight', function ($row) {
                return $row->bruto_weight ? $row->bruto_weight : '';
            });
            $table->editColumn('width', function ($row) {
                return $row->width ? $row->width : '';
            });
            $table->editColumn('height', function ($row) {
                return $row->height ? $row->height : '';
            });
            $table->editColumn('length', function ($row) {
                return $row->length ? $row->length : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'product', 'user']);

            return $table->make(true);
        }

        $crm_customers  = CrmCustomer::get();
        $products_lists = ProductsList::get();
        $users          = User::get();
        $teams          = Team::get();

        return view('admin.packingLists.index', compact('crm_customers', 'products_lists', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('packing_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packingLists.create', compact('clients', 'products', 'users'));
    }

    public function store(StorePackingListRequest $request)
    {
        $packingList = PackingList::create($request->all());

        return redirect()->route('admin.packing-lists.index');
    }

    public function edit(PackingList $packingList)
    {
        abort_if(Gate::denies('packing_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packingList->load('client', 'product', 'user', 'team');

        return view('admin.packingLists.edit', compact('clients', 'packingList', 'products', 'users'));
    }

    public function update(UpdatePackingListRequest $request, PackingList $packingList)
    {
        $packingList->update($request->all());

        return redirect()->route('admin.packing-lists.index');
    }

    public function show(PackingList $packingList)
    {
        abort_if(Gate::denies('packing_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packingList->load('client', 'product', 'user', 'team');

        return view('admin.packingLists.show', compact('packingList'));
    }

    public function destroy(PackingList $packingList)
    {
        abort_if(Gate::denies('packing_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packingList->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackingListRequest $request)
    {
        PackingList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
