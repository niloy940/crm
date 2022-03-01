@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.packingList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packing-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.id') }}
                        </th>
                        <td>
                            {{ $packingList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.client') }}
                        </th>
                        <td>
                            {{ $packingList->client->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.product') }}
                        </th>
                        <td>
                            {{ $packingList->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.quantity') }}
                        </th>
                        <td>
                            {{ $packingList->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.net_weight') }}
                        </th>
                        <td>
                            {{ $packingList->net_weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.bruto_weight') }}
                        </th>
                        <td>
                            {{ $packingList->bruto_weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.width') }}
                        </th>
                        <td>
                            {{ $packingList->width }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.height') }}
                        </th>
                        <td>
                            {{ $packingList->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.length') }}
                        </th>
                        <td>
                            {{ $packingList->length }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packingList.fields.user') }}
                        </th>
                        <td>
                            {{ $packingList->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packing-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection