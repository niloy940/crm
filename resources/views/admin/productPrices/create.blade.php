@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productPrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-prices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bom_id">{{ trans('cruds.productPrice.fields.bom') }}</label>
                <select class="form-control select2 {{ $errors->has('bom') ? 'is-invalid' : '' }}" name="bom_id" id="bom_id" required>
                    @foreach($boms as $id => $entry)
                        <option value="{{ $id }}" {{ old('bom_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bom'))
                    <span class="text-danger">{{ $errors->first('bom') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productPrice.fields.bom_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.productPrice.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.01">
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productPrice.fields.quantity_helper') }}</span>
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