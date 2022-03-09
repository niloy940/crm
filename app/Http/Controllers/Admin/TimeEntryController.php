<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTimeEntryRequest;
use App\Http\Requests\StoreTimeEntryRequest;
use App\Http\Requests\UpdateTimeEntryRequest;
use App\Models\CrmCustomer;
use App\Models\ProductsList;
use App\Models\Team;
use App\Models\TimeEntry;
use App\Models\TimeProject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeEntryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('time_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntries = TimeEntry::with(['project', 'client', 'products', 'team'])->get();

        $time_projects = TimeProject::get();

        $crm_customers = CrmCustomer::get();

        $products_lists = ProductsList::get();

        $teams = Team::get();

        return view('admin.timeEntries.index', compact('crm_customers', 'products_lists', 'teams', 'timeEntries', 'time_projects'));
    }

    public function create()
    {
        abort_if(Gate::denies('time_entry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        return view('admin.timeEntries.create', compact('clients', 'products', 'projects'));
    }

    public function store(StoreTimeEntryRequest $request)
    {
        $timeEntry = TimeEntry::create($request->all());
        $timeEntry->products()->sync($request->input('products', []));

        return redirect()->route('admin.time-entries.index');
    }

    public function edit(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        $timeEntry->load('project', 'client', 'products', 'team');

        return view('admin.timeEntries.edit', compact('clients', 'products', 'projects', 'timeEntry'));
    }

    public function update(UpdateTimeEntryRequest $request, TimeEntry $timeEntry)
    {
        $timeEntry->update($request->all());
        $timeEntry->products()->sync($request->input('products', []));

        return redirect()->route('admin.time-entries.index');
    }

    public function show(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->load('project', 'client', 'products', 'team');

        return view('admin.timeEntries.show', compact('timeEntry'));
    }

    public function destroy(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeEntryRequest $request)
    {
        TimeEntry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
