@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productsList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productsList.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_id">{{ trans('cruds.productsList.fields.warehouse') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse') ? 'is-invalid' : '' }}" name="warehouse_id" id="warehouse_id" required>
                    @foreach($warehouses as $id => $entry)
                        <option value="{{ $id }}" {{ old('warehouse_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse'))
                    <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.warehouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.productsList.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '0') }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productsList.fields.measure') }}</label>
                <select class="form-control {{ $errors->has('measure') ? 'is-invalid' : '' }}" name="measure" id="measure" required>
                    <option value disabled {{ old('measure', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductsList::MEASURE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('measure', 'pc') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('measure'))
                    <span class="text-danger">{{ $errors->first('measure') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.measure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance_optimal">{{ trans('cruds.productsList.fields.balance_optimal') }}</label>
                <input class="form-control {{ $errors->has('balance_optimal') ? 'is-invalid' : '' }}" type="number" name="balance_optimal" id="balance_optimal" value="{{ old('balance_optimal', '') }}" step="0.01" required>
                @if($errors->has('balance_optimal'))
                    <span class="text-danger">{{ $errors->first('balance_optimal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.balance_optimal_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance_min">{{ trans('cruds.productsList.fields.balance_min') }}</label>
                <input class="form-control {{ $errors->has('balance_min') ? 'is-invalid' : '' }}" type="number" name="balance_min" id="balance_min" value="{{ old('balance_min', '') }}" step="0.01" required>
                @if($errors->has('balance_min'))
                    <span class="text-danger">{{ $errors->first('balance_min') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.balance_min_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="balance_max">{{ trans('cruds.productsList.fields.balance_max') }}</label>
                <input class="form-control {{ $errors->has('balance_max') ? 'is-invalid' : '' }}" type="number" name="balance_max" id="balance_max" value="{{ old('balance_max', '') }}" step="0.01" required>
                @if($errors->has('balance_max'))
                    <span class="text-danger">{{ $errors->first('balance_max') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productsList.fields.balance_max_helper') }}</span>
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