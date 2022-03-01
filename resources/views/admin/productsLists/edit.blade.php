@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productsList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products-lists.update", [$productsList->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productsList.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productsList->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_id">{{ trans('cruds.productsList.fields.warehouse') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse') ? 'is-invalid' : '' }}" name="warehouse_id" id="warehouse_id" required>
                    @foreach($warehouses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('warehouse_id') ? old('warehouse_id') : $productsList->warehouse->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('warehouse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.warehouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.productsList.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $productsList->price) }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productsList.fields.measure') }}</label>
                <select class="form-control {{ $errors->has('measure') ? 'is-invalid' : '' }}" name="measure" id="measure" required>
                    <option value disabled {{ old('measure', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductsList::MEASURE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('measure', $productsList->measure) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('measure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('measure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.measure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance_optimal">{{ trans('cruds.productsList.fields.balance_optimal') }}</label>
                <input class="form-control {{ $errors->has('balance_optimal') ? 'is-invalid' : '' }}" type="number" name="balance_optimal" id="balance_optimal" value="{{ old('balance_optimal', $productsList->balance_optimal) }}" step="0.01" required>
                @if($errors->has('balance_optimal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_optimal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.balance_optimal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance_min">{{ trans('cruds.productsList.fields.balance_min') }}</label>
                <input class="form-control {{ $errors->has('balance_min') ? 'is-invalid' : '' }}" type="number" name="balance_min" id="balance_min" value="{{ old('balance_min', $productsList->balance_min) }}" step="0.01" required>
                @if($errors->has('balance_min'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance_min') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.balance_min_helper') }}</span>
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