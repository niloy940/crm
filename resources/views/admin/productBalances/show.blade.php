@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productBalance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalance.fields.id') }}
                        </th>
                        <td>
                            {{ $productBalance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalance.fields.name') }}
                        </th>
                        <td>
                            @foreach($productBalance->names as $key => $name)
                                <span class="label label-info">{{ $name->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalance.fields.quantity') }}
                        </th>
                        <td>
                            {{ $productBalance->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalance.fields.balance_optimal') }}
                        </th>
                        <td>
                            {{ $productBalance->balance_optimal->balance_optimal ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalance.fields.balance_min') }}
                        </th>
                        <td>
                            {{ $productBalance->balance_min->balance_min ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-balances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection