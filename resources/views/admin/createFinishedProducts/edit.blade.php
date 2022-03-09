@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.createFinishedProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.create-finished-products.update", [$createFinishedProduct->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.createFinishedProduct.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CreateFinishedProduct::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', $createFinishedProduct->shift) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <span class="text-danger">{{ $errors->first('shift') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.createFinishedProduct.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (in_array($id, old('products', [])) || $createFinishedProduct->products->contains($id)) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.createFinishedProduct.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $createFinishedProduct->quantity) }}" step="0.01" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.createFinishedProduct.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $createFinishedProduct->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expiry_date">{{ trans('cruds.createFinishedProduct.fields.expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $createFinishedProduct->expiry_date) }}" required>
                @if($errors->has('expiry_date'))
                    <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="processing_spent_id">{{ trans('cruds.createFinishedProduct.fields.processing_spent') }}</label>
                <select class="form-control select2 {{ $errors->has('processing_spent') ? 'is-invalid' : '' }}" name="processing_spent_id" id="processing_spent_id" required>
                    @foreach($processing_spents as $id => $entry)
                        <option value="{{ $id }}" {{ (old('processing_spent_id') ? old('processing_spent_id') : $createFinishedProduct->processing_spent->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('processing_spent'))
                    <span class="text-danger">{{ $errors->first('processing_spent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.processing_spent_helper') }}</span>
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
