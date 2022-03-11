@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pdfInvoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pdf-invoices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.pdfInvoice.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pdfInvoice.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PdfInvoice::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', 'invoice') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pdfInvoice.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PdfInvoice::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'unpaid') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.pdfInvoice.fields.products') }}</label>
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
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.products_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.pdfInvoice.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', '0') }}" step="0.01">
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pay_until">{{ trans('cruds.pdfInvoice.fields.pay_until') }}</label>
                <input class="form-control {{ $errors->has('pay_until') ? 'is-invalid' : '' }}" type="number" name="pay_until" id="pay_until" value="{{ old('pay_until', '') }}" step="1">
                @if($errors->has('pay_until'))
                    <span class="text-danger">{{ $errors->first('pay_until') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.pay_until_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.pdfInvoice.fields.note') }}</label>
                <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', '') }}">
                @if($errors->has('note'))
                    <span class="text-danger">{{ $errors->first('note') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pdfInvoice.fields.note_helper') }}</span>
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