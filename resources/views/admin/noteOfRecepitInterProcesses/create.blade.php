@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.noteOfRecepitInterProcess.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.note-of-recepit-inter-processes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.noteOfRecepitInterProcess.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot_id">{{ trans('cruds.noteOfRecepitInterProcess.fields.int_lot') }}</label>
                <select class="form-control select2 {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" name="int_lot_id" id="int_lot_id" required>
                    @foreach($int_lots as $id => $entry)
                        <option value="{{ $id }}" {{ old('int_lot_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.noteOfRecepitInterProcess.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_id">{{ trans('cruds.noteOfRecepitInterProcess.fields.warehouse') }}</label>
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
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.warehouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.noteOfRecepitInterProcess.fields.qc') }}</label>
                <select class="form-control {{ $errors->has('qc') ? 'is-invalid' : '' }}" name="qc" id="qc" required>
                    <option value disabled {{ old('qc', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NoteOfRecepitInterProcess::QC_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('qc', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('qc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.qc_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.noteOfRecepitInterProcess.fields.conditions') }}</label>
                <select class="form-control {{ $errors->has('conditions') ? 'is-invalid' : '' }}" name="conditions" id="conditions" required>
                    <option value disabled {{ old('conditions', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NoteOfRecepitInterProcess::CONDITIONS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('conditions', 'Čuvati na suvom i tamnom mestu.') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('conditions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conditions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.conditions_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.noteOfRecepitInterProcess.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NoteOfRecepitInterProcess::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shift') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.noteOfRecepitInterProcess.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="issuer_id">{{ trans('cruds.noteOfRecepitInterProcess.fields.issuer') }}</label>
                <select class="form-control select2 {{ $errors->has('issuer') ? 'is-invalid' : '' }}" name="issuer_id" id="issuer_id" required>
                    @foreach($issuers as $id => $entry)
                        <option value="{{ $id }}" {{ old('issuer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('issuer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issuer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.issuer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="received_by_id">{{ trans('cruds.noteOfRecepitInterProcess.fields.received_by') }}</label>
                <select class="form-control select2 {{ $errors->has('received_by') ? 'is-invalid' : '' }}" name="received_by_id" id="received_by_id" required>
                    @foreach($received_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('received_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('received_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.noteOfRecepitInterProcess.fields.received_by_helper') }}</span>
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