@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.warehouseTransfer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouse-transfers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.id') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.warehouse_from') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->warehouse_from->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.warehouse_to') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->warehouse_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.product') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.quantity') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.user') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.warehouseTransfer.fields.user_received') }}
                        </th>
                        <td>
                            {{ $warehouseTransfer->user_received->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.warehouse-transfers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection