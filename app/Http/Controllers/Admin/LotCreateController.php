<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLotCreateRequest;
use App\Http\Requests\StoreLotCreateRequest;
use App\Http\Requests\UpdateLotCreateRequest;
use App\Models\LotCreate;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LotCreateController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lot_create_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LotCreate::with(['team'])->select(sprintf('%s.*', (new LotCreate())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lot_create_show';
                $editGate = 'lot_create_edit';
                $deleteGate = 'lot_create_delete';
                $crudRoutePart = 'lot-creates';

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
            $table->editColumn('int_lot', function ($row) {
                return $row->int_lot ? $row->int_lot : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.lotCreates.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('lot_create_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lotCreates.create');
    }

    public function store(StoreLotCreateRequest $request)
    {
        $lotCreate = LotCreate::create($request->all());

        return redirect()->route('admin.lot-creates.index');
    }

    public function edit(LotCreate $lotCreate)
    {
        abort_if(Gate::denies('lot_create_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotCreate->load('team');

        return view('admin.lotCreates.edit', compact('lotCreate'));
    }

    public function update(UpdateLotCreateRequest $request, LotCreate $lotCreate)
    {
        $lotCreate->update($request->all());

        return redirect()->route('admin.lot-creates.index');
    }

    public function show(LotCreate $lotCreate)
    {
        abort_if(Gate::denies('lot_create_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotCreate->load('team');

        return view('admin.lotCreates.show', compact('lotCreate'));
    }

    public function destroy(LotCreate $lotCreate)
    {
        abort_if(Gate::denies('lot_create_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotCreate->delete();

        return back();
    }

    public function massDestroy(MassDestroyLotCreateRequest $request)
    {
        LotCreate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
