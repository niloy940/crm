@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.halfProductMake.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.half-product-makes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="halfproduct_id">{{ trans('cruds.halfProductMake.fields.halfproduct') }}</label>
                <select class="form-control select2 {{ $errors->has('halfproduct') ? 'is-invalid' : '' }}" name="halfproduct_id" id="halfproduct_id" required>
                    @foreach($halfproducts as $id => $entry)
                        <option value="{{ $id }}" {{ old('halfproduct_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('halfproduct'))
                    <span class="text-danger">{{ $errors->first('halfproduct') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.halfProductMake.fields.halfproduct_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="row col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.halfProductMake.fields.ingridients') }}</th>
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
                                        @foreach ($ingridients as $product)
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
                                        <option value="">Select One</option>
                                        @foreach ($int_lots as $int_lot)
                                            <option value="{{ $int_lot->id }}">
                                                {{ $int_lot->product->name }} - {{ $int_lot->int_lot }} ({{$int_lot->reserved_quantity}})
                                            </option>
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
                <label class="required" for="quantity">{{ trans('cruds.receiptNote.fields.int_lot_helper') }}</label>
                <input class="form-control {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" type="text" name="int_lot" id="int_lot" value="{{ old('int_lot', '') }}" required>
                @if($errors->has('int_lot'))
                    <span class="text-danger">{{ $errors->first('int_lot') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="made_by_id">{{ trans('cruds.halfProductMake.fields.made_by') }}</label>
                <select class="form-control select2 {{ $errors->has('made_by') ? 'is-invalid' : '' }}" name="made_by_id" id="made_by_id" required>
                    <option value="{{ auth()->user()->id }}" {{ old('made_by_id') == auth()->user()->id ? 'selected' : '' }}>{{ auth()->user()->name }}</option>
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

@section('scripts')
    <script type="text/javascript">

        $('#addRow').on('click', function() {
            addRow();
        })

        function addRow() {
            
            var tr = '<tr>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("products") ? "is-invalid" : "" }}" name="products[]" id="products" required>' +
                                "@foreach ($ingridients as $product)" +
                                    '<option value="{{ $product->id }}">' +
                                        "{{ $product->name }}" +
                                    '</option>' +
                                "@endforeach" +
                            '</select>' +
                        '</td>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("int_lots") ? "is-invalid" : "" }}" name="int_lots[]" id="int_lots" required>' +
                                '<option value="">Select One</option>' +
                                "@foreach ($int_lots as $int_lot)" +
                                    '<option value="{{ $int_lot->id }}">' +
                                        "{{ $int_lot->product->name }} {{ $int_lot->int_lot }} ({{ $int_lot->reserved_quantity }})" +
                                    '</option>' +
                                "@endforeach" +
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


        // internal lot
        $(function() {
            $("#int_lot").attr("value", Math.floor(Math.random() * 1000000) + uid());
        });

        //unique
        function uid(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            return today =  yyyy + mm + dd;
        }

    </script>
@endsection