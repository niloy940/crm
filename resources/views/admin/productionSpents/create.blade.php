@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productionSpent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.production-spents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productionSpent.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.productionSpent.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <div class="invalid-feedback">
                        {{ $errors->first('products') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.productionSpent.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productionSpent.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductionSpent::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shift') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_time">{{ trans('cruds.productionSpent.fields.date_time') }}</label>
                <input class="form-control datetime {{ $errors->has('date_time') ? 'is-invalid' : '' }}" type="text" name="date_time" id="date_time" value="{{ old('date_time') }}" required>
                @if($errors->has('date_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.date_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ingridients_id">{{ trans('cruds.productionSpent.fields.ingridients') }}</label>
                <select class="form-control select2 {{ $errors->has('ingridients') ? 'is-invalid' : '' }}" name="ingridients_id" id="ingridients_id">
                    @foreach($ingridients as $id => $entry)
                        <option value="{{ $id }}" {{ old('ingridients_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ingridients'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ingridients') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.ingridients_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity_ing">{{ trans('cruds.productionSpent.fields.quantity_ing') }}</label>
                <input class="form-control {{ $errors->has('quantity_ing') ? 'is-invalid' : '' }}" type="number" name="quantity_ing" id="quantity_ing" value="{{ old('quantity_ing', '') }}" step="0.001" required>
                @if($errors->has('quantity_ing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity_ing') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.quantity_ing_helper') }}</span>
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