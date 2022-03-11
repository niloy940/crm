@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.warehouseSector.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouse-sectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseSector.fields.id') }}
                        </th>
                        <td>
                            {{ $warehouseSector->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseSector.fields.name') }}
                        </th>
                        <td>
                            {{ $warehouseSector->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouse-sectors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection