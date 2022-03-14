<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLotTrackRequest;
use App\Http\Requests\StoreLotTrackRequest;
use App\Http\Requests\UpdateLotTrackRequest;
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
            $query = LotTrack::with(['team'])->select(sprintf('%s.*', (new LotTrack())->table));
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.lotTracks.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('lot_track_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lotTracks.create');
    }

    public function store(StoreLotTrackRequest $request)
    {
        $lotTrack = LotTrack::create($request->all());

        return redirect()->route('admin.lot-tracks.index');
    }

    public function edit(LotTrack $lotTrack)
    {
        abort_if(Gate::denies('lot_track_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotTrack->load('team');

        return view('admin.lotTracks.edit', compact('lotTrack'));
    }

    public function update(UpdateLotTrackRequest $request, LotTrack $lotTrack)
    {
        $lotTrack->update($request->all());

        return redirect()->route('admin.lot-tracks.index');
    }

    public function show(LotTrack $lotTrack)
    {
        abort_if(Gate::denies('lot_track_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lotTrack->load('team');

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
