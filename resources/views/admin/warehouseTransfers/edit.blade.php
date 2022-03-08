@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.warehouseTransfer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.warehouse-transfers.update", [$warehouseTransfer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="warehouse_from_id">{{ trans('cruds.warehouseTransfer.fields.warehouse_from') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse_from') ? 'is-invalid' : '' }}" name="warehouse_from_id" id="warehouse_from_id" required>
                    @foreach($warehouse_froms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('warehouse_from_id') ? old('warehouse_from_id') : $warehouseTransfer->warehouse_from->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('warehouse_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.warehouse_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_to_id">{{ trans('cruds.warehouseTransfer.fields.warehouse_to') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse_to') ? 'is-invalid' : '' }}" name="warehouse_to_id" id="warehouse_to_id" required>
                    @foreach($warehouse_tos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('warehouse_to_id') ? old('warehouse_to_id') : $warehouseTransfer->warehouse_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('warehouse_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.warehouse_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot_id">{{ trans('cruds.warehouseTransfer.fields.int_lot') }}</label>
                <select class="form-control select2 {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" name="int_lot_id" id="int_lot_id" required>
                    @foreach($int_lots as $id => $entry)
                        <option value="{{ $id }}" {{ (old('int_lot_id') ? old('int_lot_id') : $warehouseTransfer->int_lot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.int_lot_helper') }}</span>
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