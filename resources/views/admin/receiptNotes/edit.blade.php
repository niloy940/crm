@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.receiptNote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.receipt-notes.update", [$receiptNote->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.receiptNote.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple required>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (in_array($id, old('products', [])) || $receiptNote->products->contains($id)) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.receiptNote.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $receiptNote->quantity) }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lot">{{ trans('cruds.receiptNote.fields.lot') }}</label>
                <input class="form-control {{ $errors->has('lot') ? 'is-invalid' : '' }}" type="text" name="lot" id="lot" value="{{ old('lot', $receiptNote->lot) }}" required>
                @if($errors->has('lot'))
                    <span class="text-danger">{{ $errors->first('lot') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot">{{ trans('cruds.receiptNote.fields.int_lot') }}</label>
                <input class="form-control {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" type="text" name="int_lot" id="int_lot" value="{{ old('int_lot', $receiptNote->int_lot) }}" required>
                @if($errors->has('int_lot'))
                    <span class="text-danger">{{ $errors->first('int_lot') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expiry_date">{{ trans('cruds.receiptNote.fields.expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $receiptNote->expiry_date) }}" required>
                @if($errors->has('expiry_date'))
                    <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_id">{{ trans('cruds.receiptNote.fields.warehouse') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse') ? 'is-invalid' : '' }}" name="warehouse_id" id="warehouse_id" required>
                    @foreach($warehouses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('warehouse_id') ? old('warehouse_id') : $receiptNote->warehouse->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse'))
                    <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.warehouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sector_id">{{ trans('cruds.receiptNote.fields.sector') }}</label>
                <select class="form-control select2 {{ $errors->has('sector') ? 'is-invalid' : '' }}" name="sector_id" id="sector_id" required>
                    @foreach($sectors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sector_id') ? old('sector_id') : $receiptNote->sector->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sector'))
                    <span class="text-danger">{{ $errors->first('sector') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.sector_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shelf">{{ trans('cruds.receiptNote.fields.shelf') }}</label>
                <input class="form-control {{ $errors->has('shelf') ? 'is-invalid' : '' }}" type="text" name="shelf" id="shelf" value="{{ old('shelf', $receiptNote->shelf) }}">
                @if($errors->has('shelf'))
                    <span class="text-danger">{{ $errors->first('shelf') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.shelf_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.qc') }}</label>
                <select class="form-control {{ $errors->has('qc') ? 'is-invalid' : '' }}" name="qc" id="qc" required>
                    <option value disabled {{ old('qc', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::QC_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('qc', $receiptNote->qc) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('qc'))
                    <span class="text-danger">{{ $errors->first('qc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.qc_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.conditions') }}</label>
                <select class="form-control {{ $errors->has('conditions') ? 'is-invalid' : '' }}" name="conditions" id="conditions" required>
                    <option value disabled {{ old('conditions', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::CONDITIONS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('conditions', $receiptNote->conditions) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('conditions'))
                    <span class="text-danger">{{ $errors->first('conditions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.conditions_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', $receiptNote->shift) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <span class="text-danger">{{ $errors->first('shift') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.receiptNote.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $receiptNote->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place">{{ trans('cruds.receiptNote.fields.place') }}</label>
                <input class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}" type="text" name="place" id="place" value="{{ old('place', $receiptNote->place) }}" required>
                @if($errors->has('place'))
                    <span class="text-danger">{{ $errors->first('place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="driver">{{ trans('cruds.receiptNote.fields.driver') }}</label>
                <input class="form-control {{ $errors->has('driver') ? 'is-invalid' : '' }}" type="text" name="driver" id="driver" value="{{ old('driver', $receiptNote->driver) }}" required>
                @if($errors->has('driver'))
                    <span class="text-danger">{{ $errors->first('driver') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.driver_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_driver">{{ trans('cruds.receiptNote.fields.id_driver') }}</label>
                <input class="form-control {{ $errors->has('id_driver') ? 'is-invalid' : '' }}" type="text" name="id_driver" id="id_driver" value="{{ old('id_driver', $receiptNote->id_driver) }}" required>
                @if($errors->has('id_driver'))
                    <span class="text-danger">{{ $errors->first('id_driver') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.id_driver_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="registration">{{ trans('cruds.receiptNote.fields.registration') }}</label>
                <input class="form-control {{ $errors->has('registration') ? 'is-invalid' : '' }}" type="text" name="registration" id="registration" value="{{ old('registration', $receiptNote->registration) }}" required>
                @if($errors->has('registration'))
                    <span class="text-danger">{{ $errors->first('registration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.registration_helper') }}</span>
            </div>
            <div class="form-group" style="visibility: hidden;">
                <label class="required" for="issuer_id">{{ trans('cruds.receiptNote.fields.issuer') }}</label>
                <select class="form-control select2 {{ $errors->has('issuer') ? 'is-invalid' : '' }}" name="issuer_id" id="issuer_id" required>
                    @foreach($issuers as $id => $entry)
                        @if(Auth::id() == $id)
                            <option value="{{ $id }}" {{ old('issuer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('issuer'))
                    <span class="text-danger">{{ $errors->first('issuer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.issuer_helper') }}</span>
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
