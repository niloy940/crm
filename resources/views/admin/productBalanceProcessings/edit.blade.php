@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productBalanceProcessing.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-balance-processings.update", [$productBalanceProcessing->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="halfproduct_id">{{ trans('cruds.productBalanceProcessing.fields.halfproduct') }}</label>
                <select class="form-control select2 {{ $errors->has('halfproduct') ? 'is-invalid' : '' }}" name="halfproduct_id" id="halfproduct_id">
                    @foreach($halfproducts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('halfproduct_id') ? old('halfproduct_id') : $productBalanceProcessing->halfproduct->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('halfproduct'))
                    <span class="text-danger">{{ $errors->first('halfproduct') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productBalanceProcessing.fields.halfproduct_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_min_id">{{ trans('cruds.productBalanceProcessing.fields.balance_min') }}</label>
                <select class="form-control select2 {{ $errors->has('balance_min') ? 'is-invalid' : '' }}" name="balance_min_id" id="balance_min_id">
                    @foreach($balance_mins as $id => $entry)
                        <option value="{{ $id }}" {{ (old('balance_min_id') ? old('balance_min_id') : $productBalanceProcessing->balance_min->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('balance_min'))
                    <span class="text-danger">{{ $errors->first('balance_min') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productBalanceProcessing.fields.balance_min_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_optimal_id">{{ trans('cruds.productBalanceProcessing.fields.balance_optimal') }}</label>
                <select class="form-control select2 {{ $errors->has('balance_optimal') ? 'is-invalid' : '' }}" name="balance_optimal_id" id="balance_optimal_id">
                    @foreach($balance_optimals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('balance_optimal_id') ? old('balance_optimal_id') : $productBalanceProcessing->balance_optimal->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('balance_optimal'))
                    <span class="text-danger">{{ $errors->first('balance_optimal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productBalanceProcessing.fields.balance_optimal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_max">{{ trans('cruds.productBalanceProcessing.fields.balance_max') }}</label>
                <input class="form-control {{ $errors->has('balance_max') ? 'is-invalid' : '' }}" type="number" name="balance_max" id="balance_max" value="{{ old('balance_max', $productBalanceProcessing->balance_max) }}" step="0.01">
                @if($errors->has('balance_max'))
                    <span class="text-danger">{{ $errors->first('balance_max') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productBalanceProcessing.fields.balance_max_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection