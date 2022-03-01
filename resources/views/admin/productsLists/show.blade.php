@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productsList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productsList.fields.id') }}
                        </th>
                        <td>
                            {{ $productsList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsList.fields.name') }}
                        </th>
                        <td>
                            {{ $productsList->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsList.fields.warehouse') }}
                        </th>
                        <td>
                            {{ $productsList->warehouse->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsList.fields.price') }}
                        </th>
                        <td>
                            {{ $productsList->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productsList.fields.int_lot') }}
                        </th>
                        <td>
                            @foreach($productsList->int_lots as $key => $int_lot)
                                <span class="label label-info">{{ $int_lot->int_lot }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection