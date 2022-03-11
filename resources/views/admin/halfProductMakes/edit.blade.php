@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.halfProductMake.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.half-product-makes.update", [$halfProductMake->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="halfproduct_id">{{ trans('cruds.halfProductMake.fields.halfproduct') }}</label>
                <select class="form-control select2 {{ $errors->has('halfproduct') ? 'is-invalid' : '' }}" name="halfproduct_id" id="halfproduct_id" required>
                    @foreach($halfproducts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('halfproduct_id') ? old('halfproduct_id') : $halfProductMake->halfproduct->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('halfproduct'))
                    <span class="text-danger">{{ $errors->first('halfproduct') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.halfproduct_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ingridients">{{ trans('cruds.halfProductMake.fields.ingridients') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('ingridients') ? 'is-invalid' : '' }}" name="ingridients[]" id="ingridients" multiple required>
                    @foreach($ingridients as $id => $ingridient)
                        <option value="{{ $id }}" {{ (in_array($id, old('ingridients', [])) || $halfProductMake->ingridients->contains($id)) ? 'selected' : '' }}>{{ $ingridient }}</option>
                    @endforeach
                </select>
                @if($errors->has('ingridients'))
                    <span class="text-danger">{{ $errors->first('ingridients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.ingridients_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.halfProductMake.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $halfProductMake->quantity) }}" step="0.01" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lots">{{ trans('cruds.halfProductMake.fields.int_lot') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('int_lots') ? 'is-invalid' : '' }}" name="int_lots[]" id="int_lots" multiple required>
                    @foreach($int_lots as $id => $int_lot)
                        <option value="{{ $id }}" {{ (in_array($id, old('int_lots', [])) || $halfProductMake->int_lots->contains($id)) ? 'selected' : '' }}>{{ $int_lot }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lots'))
                    <span class="text-danger">{{ $errors->first('int_lots') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="made_by_id">{{ trans('cruds.halfProductMake.fields.made_by') }}</label>
                <select class="form-control select2 {{ $errors->has('made_by') ? 'is-invalid' : '' }}" name="made_by_id" id="made_by_id" required>
                    @foreach($made_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('made_by_id') ? old('made_by_id') : $halfProductMake->made_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('made_by'))
                    <span class="text-danger">{{ $errors->first('made_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.made_by_helper') }}</span>
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