@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.timeEntry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.time-entries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.id') }}
                        </th>
                        <td>
                            {{ $timeEntry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.project') }}
                        </th>
                        <td>
                            {{ $timeEntry->project->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.client') }}
                        </th>
                        <td>
                            {{ $timeEntry->client->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.products') }}
                        </th>
                        <td>
                            @foreach($timeEntry->products as $key => $products)
                                <span class="label label-info">{{ $products->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.start_time') }}
                        </th>
                        <td>
                            {{ $timeEntry->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.timeEntry.fields.end_time') }}
                        </th>
                        <td>
                            {{ $timeEntry->end_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.time-entries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection