@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.createFinishedProduct.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.create-finished-products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.createFinishedProduct.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CreateFinishedProduct::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <span class="text-danger">{{ $errors->first('shift') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.shift_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.createFinishedProduct.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.createFinishedProduct.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.01" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.quantity_helper') }}</span>
            </div> --}}

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
                                        @foreach ($half_products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>         
                                <td>
                                    <select
                                        class="form-control form-select {{ $errors->has('int_lots') ? 'is-invalid' : '' }}"
                                        name="int_lots[]" id="int_lots" required>
                                        <option>{{trans('global.pleaseSelect')}}</option>
                                        @foreach ($processing_spents as $processing_spent)
                                            @foreach ($processing_spent->halfProducts as $half_product)     
                                                <option value="{{ $half_product->pivot->int_lot }}">
                                                    {{ $half_product->name }} - {{ $half_product->pivot->int_lot }} ({{$half_product->pivot->quantity}})
                                                </option> 
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
                <label class="required" for="user_id">{{ trans('cruds.createFinishedProduct.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    <option value="{{ auth()->user()->id }}" {{ old('user_id') == auth()->user()->id ? 'selected' : '' }}>{{ auth()->user()->name }}</option>
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.user_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="expiry_date">{{ trans('cruds.createFinishedProduct.fields.expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" required>
                @if($errors->has('expiry_date'))
                    <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="processing_spent_id">{{ trans('cruds.createFinishedProduct.fields.processing_spent') }}</label>
                <select class="form-control select2 {{ $errors->has('processing_spent') ? 'is-invalid' : '' }}" name="processing_spent_id" id="processing_spent_id" required>
                    <option>{{trans('global.pleaseSelect')}}</option>
                    @foreach($processing_spents as $processing_spent)
                        <option value="{{ $processing_spent->id }}" {{ old('processing_spent_id') == $processing_spent->id ? 'selected' : '' }}>{{ $processing_spent->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('processing_spent'))
                    <span class="text-danger">{{ $errors->first('processing_spent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.createFinishedProduct.fields.processing_spent_helper') }}</span>
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
    <script type="text/javascript">

        $('#addRow').on('click', function() {
            addRow();
        })

        function addRow() {
            
            var tr = '<tr>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("products") ? "is-invalid" : "" }}" name="products[]" id="products" required>' +
                                "@foreach ($half_products as $product)" +
                                    '<option value="{{ $product->id }}">' +
                                        "{{ $product->name }}" +
                                    '</option>' +
                                "@endforeach" +
                            '</select>' +
                        '</td>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("int_lots") ? "is-invalid" : "" }}" name="int_lots[]" id="int_lots" required>' +
                                '<option value="">Select One</option>' +
                                    '@foreach ($processing_spents as $processing_spent)' +
                                        '@foreach ($processing_spent->halfProducts as $half_product)' +     
                                            '<option value="{{ $half_product->pivot->int_lot }}">' + 
                                                '{{ $half_product->name }} - {{ $half_product->pivot->int_lot }} ({{$half_product->pivot->quantity}})' +
                                            '</option>' + 
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