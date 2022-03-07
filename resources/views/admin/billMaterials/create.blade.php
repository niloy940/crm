@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.billMaterial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bill-materials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.billMaterial.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="for_product_id">{{ trans('cruds.billMaterial.fields.for_product') }}</label>
                <select class="form-control select2 {{ $errors->has('for_product') ? 'is-invalid' : '' }}" name="for_product_id" id="for_product_id" required>
                    @foreach($for_products as $id => $entry)
                        <option value="{{ $id }}" {{ old('for_product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('for_product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.for_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ingridients">{{ trans('cruds.billMaterial.fields.ingridients') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('ingridients') ? 'is-invalid' : '' }}" name="ingridients[]" id="ingridients" multiple required>
                    @foreach($ingridients as $id => $ingridient)
                        <option value="{{ $id }}" {{ in_array($id, old('ingridients', [])) ? 'selected' : '' }}>{{ $ingridient }}</option>
                    @endforeach
                </select>
                @if($errors->has('ingridients'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ingridients') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.ingridients_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.billMaterial.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.001" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.billMaterial.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coefficient">{{ trans('cruds.billMaterial.fields.coefficient') }}</label>
                <input class="form-control {{ $errors->has('coefficient') ? 'is-invalid' : '' }}" type="number" name="coefficient" id="coefficient" value="{{ old('coefficient', '') }}" step="0.001" required>
                @if($errors->has('coefficient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coefficient') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billMaterial.fields.coefficient_helper') }}</span>
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