@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productionOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.production-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productionOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $productionOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionOrder.fields.client') }}
                        </th>
                        <td>
                            {{ $productionOrder->client->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionOrder.fields.due_date') }}
                        </th>
                        <td>
                            {{ $productionOrder->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionOrder.fields.recommended') }}
                        </th>
                        <td>
                            {{ $productionOrder->recommended }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionOrder.fields.description') }}
                        </th>
                        <td>
                            {{ $productionOrder->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.production-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection