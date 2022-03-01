<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLotTrackRequest;
use App\Http\Requests\StoreLotTrackRequest;
use App\Http\Requests\UpdateLotTrackRequest;
use App\Models\LotCreate;
use App\Models\LotTrack;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LotTrackController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lot_track_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LotTrack::with(['int_lots', 'team'])->select(sprintf('%s.*', (new LotTrack())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lot_track_show';
                $editGate = 'lot_track_edit';
                $deleteGate = 'lot_track_delete';
                $crudRoutePart = 'lot-tracks';

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
                $labels = [];
                foreach ($row->int_lots as $int_lot) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $int_lot->int_lot);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'int_lot']);

            return $table->make(true);
        }

        $lot_creates = LotCreate::get();
        $teams       = Team::get();

        return view('admin.lotTracks.index', compact('lot_creates', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('lot_track_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $int_lots = LotCreate::pluck('int_lot', 'id');

        return view('admin.lotTracks.create', compact('int_lots'));
    }

    public function store(StoreLotTrackRequest $request)
    {
        $lotTrack = LotTrack::create($request->all());
        $lotTrack->int_lots()->sync($request->input('int_lots', []));

        return redirect()->route('admin.lot-tracks.index');
    }

    public function edit(LotTrack $lotTrack)
    {
        abort_if(Gate::denies('lot_track_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $int_lots = LotCreate::pluck('int_lot', 'id');

        $lotTrack->load('int_lots', 'team');

        return view('admin.lotTracks.edit', compact('int_lots', 'lotTrack'));
    }

    public function update(UpdateLotTrackRequest $request, LotTrack $lotTrack)
    {
        $lotTrack->update($request->all());
        $lotTrack->int_lots()->sync($request->input('int_lots', []));

        return redirect()->route('admin.lot-tracks.index');
    }

    public function show(LotTrack $lotTrack)
    {
        abort_if(Gate::denies('lot_track_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotTrack->load('int_lots', 'team');

        return view('admin.lotTracks.show', compact('lotTrack'));
    }

    public function destroy(LotTrack $lotTrack)
    {
        abort_if(Gate::denies('lot_track_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotTrack->delete();

        return back();
    }

    public function massDestroy(MassDestroyLotTrackRequest $request)
    {
        LotTrack::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
