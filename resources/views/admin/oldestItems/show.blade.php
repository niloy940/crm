@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.oldestItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.oldest-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.oldestItem.fields.id') }}
                        </th>
                        <td>
                            {{ $oldestItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.oldestItem.fields.product') }}
                        </th>
                        <td>
                            {{ $oldestItem->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.oldestItem.fields.expiry_date') }}
                        </th>
                        <td>
                            @foreach($oldestItem->expiry_dates as $key => $expiry_date)
                                <span class="label label-info">{{ $expiry_date->expiry_date }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.oldestItem.fields.quantity') }}
                        </th>
                        <td>
                            {{ $oldestItem->quantity->quantity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.oldestItem.fields.int_lot') }}
                        </th>
                        <td>
                            {{ $oldestItem->int_lot->lot ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.oldest-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection