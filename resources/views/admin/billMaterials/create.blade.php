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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection