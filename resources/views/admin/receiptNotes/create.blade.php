@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.receiptNote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.receipt-notes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.receiptNote.fields.client') }}</label>
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
                <span class="help-block">{{ trans('cruds.receiptNote.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.receiptNote.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.receiptNote.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.receiptNote.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lot">{{ trans('cruds.receiptNote.fields.lot') }}</label>
                <input class="form-control {{ $errors->has('lot') ? 'is-invalid' : '' }}" type="text" name="lot" id="lot" value="{{ old('lot', '') }}" required>
                @if($errors->has('lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot">{{ trans('cruds.receiptNote.fields.int_lot') }}</label>
                <input class="form-control {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" type="text" name="int_lot" id="int_lot" value="{{ old('int_lot', 'SI_') }}" required>
                @if($errors->has('int_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expiry_date">{{ trans('cruds.receiptNote.fields.expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" required>
                @if($errors->has('expiry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiry_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_id">{{ trans('cruds.receiptNote.fields.warehouse') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse') ? 'is-invalid' : '' }}" name="warehouse_id" id="warehouse_id" required>
                    @foreach($warehouses as $id => $entry)
                        <option value="{{ $id }}" {{ old('warehouse_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('warehouse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.warehouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.qc') }}</label>
                <select class="form-control {{ $errors->has('qc') ? 'is-invalid' : '' }}" name="qc" id="qc" required>
                    <option value disabled {{ old('qc', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::QC_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('qc', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('qc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.qc_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.conditions') }}</label>
                <select class="form-control {{ $errors->has('conditions') ? 'is-invalid' : '' }}" name="conditions" id="conditions" required>
                    <option value disabled {{ old('conditions', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::CONDITIONS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('conditions', 'Čuvati na suvom i tamnom mestu.') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('conditions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conditions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.conditions_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.receiptNote.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ReceiptNote::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shift') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.receiptNote.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place">{{ trans('cruds.receiptNote.fields.place') }}</label>
                <input class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}" type="text" name="place" id="place" value="{{ old('place', 'Banatski Karlovac') }}" required>
                @if($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="driver">{{ trans('cruds.receiptNote.fields.driver') }}</label>
                <input class="form-control {{ $errors->has('driver') ? 'is-invalid' : '' }}" type="text" name="driver" id="driver" value="{{ old('driver', '') }}" required>
                @if($errors->has('driver'))
                    <div class="invalid-feedback">
                        {{ $errors->first('driver') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.driver_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_driver">{{ trans('cruds.receiptNote.fields.id_driver') }}</label>
                <input class="form-control {{ $errors->has('id_driver') ? 'is-invalid' : '' }}" type="text" name="id_driver" id="id_driver" value="{{ old('id_driver', '') }}" required>
                @if($errors->has('id_driver'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_driver') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.id_driver_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="registration">{{ trans('cruds.receiptNote.fields.registration') }}</label>
                <input class="form-control {{ $errors->has('registration') ? 'is-invalid' : '' }}" type="text" name="registration" id="registration" value="{{ old('registration', '') }}" required>
                @if($errors->has('registration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('registration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.receiptNote.fields.registration_helper') }}</span>
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