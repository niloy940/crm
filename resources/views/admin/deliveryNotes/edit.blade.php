@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.deliveryNote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.delivery-notes.update", [$deliveryNote->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.deliveryNote.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $deliveryNote->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.deliveryNote.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $deliveryNote->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot_id">{{ trans('cruds.deliveryNote.fields.int_lot') }}</label>
                <select class="form-control select2 {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" name="int_lot_id" id="int_lot_id" required>
                    @foreach($int_lots as $id => $entry)
                        <option value="{{ $id }}" {{ (old('int_lot_id') ? old('int_lot_id') : $deliveryNote->int_lot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.deliveryNote.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $deliveryNote->quantity) }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="issuer_id">{{ trans('cruds.deliveryNote.fields.issuer') }}</label>
                <select class="form-control select2 {{ $errors->has('issuer') ? 'is-invalid' : '' }}" name="issuer_id" id="issuer_id" required>
                    @foreach($issuers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('issuer_id') ? old('issuer_id') : $deliveryNote->issuer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('issuer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issuer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.issuer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document">{{ trans('cruds.deliveryNote.fields.document') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document') ? 'is-invalid' : '' }}" id="document-dropzone">
                </div>
                @if($errors->has('document'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.document_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedDocumentMap = {}
Dropzone.options.documentDropzone = {
    url: '{{ route('admin.delivery-notes.storeMedia') }}',
    maxFilesize: 3, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($deliveryNote) && $deliveryNote->document)
          var files =
            {!! json_encode($deliveryNote->document) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection