@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productBalanceProcessing.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-balance-processings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.id') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.halfproduct') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->halfproduct->quantity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.quantity') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_min') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->balance_min->balance_min ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_optimal') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->balance_optimal->balance_optimal ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_max') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->balance_max }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_reserved') }}
                        </th>
                        <td>
                            {{ $productBalanceProcessing->balance_reserved }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-balance-processings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection