@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productBalance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-balances.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="balance_optimal_id">{{ trans('cruds.productBalance.fields.balance_optimal') }}</label>
                <select class="form-control select2 {{ $errors->has('balance_optimal') ? 'is-invalid' : '' }}" name="balance_optimal_id" id="balance_optimal_id">
                    @foreach($balance_optimals as $id => $entry)
                        <option value="{{ $id }}" {{ old('balance_optimal_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('balance_optimal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_optimal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productBalance.fields.balance_optimal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_min_id">{{ trans('cruds.productBalance.fields.balance_min') }}</label>
                <select class="form-control select2 {{ $errors->has('balance_min') ? 'is-invalid' : '' }}" name="balance_min_id" id="balance_min_id">
                    @foreach($balance_mins as $id => $entry)
                        <option value="{{ $id }}" {{ old('balance_min_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('balance_min'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_min') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productBalance.fields.balance_min_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance_max">{{ trans('cruds.productBalance.fields.balance_max') }}</label>
                <input class="form-control {{ $errors->has('balance_max') ? 'is-invalid' : '' }}" type="number" name="balance_max" id="balance_max" value="{{ old('balance_max', '') }}" step="0.01">
                @if($errors->has('balance_max'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_max') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productBalance.fields.balance_max_helper') }}</span>
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