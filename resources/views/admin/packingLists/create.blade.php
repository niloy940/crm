@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.packingList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.packing-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.packingList.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.packingList.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.packingList.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="net_weight">{{ trans('cruds.packingList.fields.net_weight') }}</label>
                <input class="form-control {{ $errors->has('net_weight') ? 'is-invalid' : '' }}" type="number" name="net_weight" id="net_weight" value="{{ old('net_weight', '') }}" step="0.001" required>
                @if($errors->has('net_weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('net_weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.net_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bruto_weight">{{ trans('cruds.packingList.fields.bruto_weight') }}</label>
                <input class="form-control {{ $errors->has('bruto_weight') ? 'is-invalid' : '' }}" type="number" name="bruto_weight" id="bruto_weight" value="{{ old('bruto_weight', '') }}" step="0.001" required>
                @if($errors->has('bruto_weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bruto_weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.bruto_weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="width">{{ trans('cruds.packingList.fields.width') }}</label>
                <input class="form-control {{ $errors->has('width') ? 'is-invalid' : '' }}" type="number" name="width" id="width" value="{{ old('width', '') }}" step="1" required>
                @if($errors->has('width'))
                    <div class="invalid-feedback">
                        {{ $errors->first('width') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.width_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="height">{{ trans('cruds.packingList.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', '') }}" step="1" required>
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="length">{{ trans('cruds.packingList.fields.length') }}</label>
                <input class="form-control {{ $errors->has('length') ? 'is-invalid' : '' }}" type="number" name="length" id="length" value="{{ old('length', '') }}" step="1" required>
                @if($errors->has('length'))
                    <div class="invalid-feedback">
                        {{ $errors->first('length') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.length_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.packingList.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.packingList.fields.user_helper') }}</span>
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