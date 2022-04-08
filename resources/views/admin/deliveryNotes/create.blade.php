@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.deliveryNote.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.delivery-notes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.deliveryNote.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.client_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="row col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.productionSpent.fields.product') }}</th>
                                <th>{{ trans('cruds.receiptNote.fields.int_lot_helper') }}</th>
                                <th>{{ trans('cruds.receiptNote.fields.quantity') }}</th>
                                <th><a href="#" id="addRow" class="btn btn-info">+</a></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <select
                                        class="form-control form-select {{ $errors->has('products') ? 'is-invalid' : '' }}"
                                        name="products[]" id="products" required>
                                        <option>{{trans('global.pleaseSelect')}}</option>
                                        @foreach ($finished_products as $finished_product)
                                            @foreach ($finished_product->halfProducts as $product)
                                                @if ($product->pivot->quantity > 0)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }} ({{$product->pivot->quantity}})
                                                    </option>
                                                    @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>         
                                <td>
                                    <select
                                        class="form-control form-select {{ $errors->has('int_lots') ? 'is-invalid' : '' }}"
                                        name="int_lots[]" id="int_lots" required>
                                        <option>{{trans('global.pleaseSelect')}}</option>
                                        @foreach ($finished_products as $finished_product)
                                            @foreach ($finished_product->halfProducts as $half_product)  
                                                @if ($half_product->pivot->quantity > 0)
                                                    <option value="{{ $half_product->pivot->int_lot }}">
                                                        {{ $half_product->name }} - {{ $half_product->pivot->int_lot }} ({{$half_product->pivot->quantity}})
                                                    </option> 
                                                @endif   
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control {{ $errors->has('quantities') ? 'is-invalid' : '' }}" type="number"
                                        name="quantities[]" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                                    @if ($errors->has('quantities'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('quantities') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="form-group">
                <label class="required" for="issuer_id">{{ trans('cruds.deliveryNote.fields.issuer') }}</label>
                <select class="form-control select2 {{ $errors->has('issuer') ? 'is-invalid' : '' }}" name="issuer_id" id="issuer_id" required>  
                    <option value="{{ auth()->user()->id }}" {{ old('issuer_id') == auth()->user()->id ? 'selected' : '' }}>{{ auth()->user()->name }}</option>
                </select>
                @if($errors->has('issuer'))
                    <span class="text-danger">{{ $errors->first('issuer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.deliveryNote.fields.issuer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document">{{ trans('cruds.deliveryNote.fields.document') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document') ? 'is-invalid' : '' }}" id="document-dropzone">
                </div>
                @if($errors->has('document'))
                    <span class="text-danger">{{ $errors->first('document') }}</span>
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


$('#addRow').on('click', function() {
            addRow();
        })

        function addRow() {
            
            var tr = '<tr>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("products") ? "is-invalid" : "" }}" name="products[]" id="products" required>' +
                                '@foreach ($finished_products as $finished_product)' +
                                    '@foreach ($finished_product->halfProducts as $product)' +
                                        '@if ($product->pivot->quantity > 0)' +
                                            '<option value="{{ $product->id }}">' +
                                                '{{ $product->name }} ({{$product->pivot->quantity}})' +
                                            '</option>' +
                                        '@endif' +
                                    '@endforeach' +
                                '@endforeach' +
                            '</select>' +
                        '</td>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("int_lots") ? "is-invalid" : "" }}" name="int_lots[]" id="int_lots" required>' +
                                '<option value="">Select One</option>' +
                                    '@foreach ($finished_products as $finished_product)' +
                                        '@foreach ($finished_product->halfProducts as $half_product)' +  
                                            '@if ($half_product->pivot->quantity > 0)' +
                                                '<option value="{{ $half_product->pivot->int_lot }}">' +
                                                    '{{ $half_product->name }} - {{ $half_product->pivot->int_lot }} ({{$half_product->pivot->quantity}})' +
                                                '</option> ' +
                                            '@endif' +  
                                        '@endforeach' +
                                    '@endforeach' +
                            '</select>' +
                        '</td>' +
                        '<td><input class="form-control" type="text" name="quantities[]" id="quantities" required></td>' +
                        '<td><a href="#" id="remove" class="btn btn-danger">-</a></td>' +
                    '</tr>';
            
            $('tbody').append(tr)
        }

        $('tbody').on('click', '#remove', function() {
            $(this).parent().parent().remove();
        })
</script>
@endsection
