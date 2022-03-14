@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.createFinishedProduct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.create-finished-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.id') }}
                        </th>
                        <td>
                            {{ $createFinishedProduct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.shift') }}
                        </th>
                        <td>
                            {{ App\Models\CreateFinishedProduct::SHIFT_SELECT[$createFinishedProduct->shift] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.product') }}
                        </th>
                        <td>
                            @foreach($createFinishedProduct->products as $key => $product)
                                <span class="label label-info">{{ $product->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.quantity') }}
                        </th>
                        <td>
                            {{ $createFinishedProduct->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.user') }}
                        </th>
                        <td>
                            {{ $createFinishedProduct->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $createFinishedProduct->expiry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.createFinishedProduct.fields.processing_spent') }}
                        </th>
                        <td>
                            {{ $createFinishedProduct->processing_spent->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.create-finished-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection