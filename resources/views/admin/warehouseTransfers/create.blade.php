@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.warehouseTransfer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.warehouse-transfers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="warehouse_from_id">{{ trans('cruds.warehouseTransfer.fields.warehouse_from') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse_from') ? 'is-invalid' : '' }}" name="warehouse_from_id" id="warehouse_from_id" required>
                    @foreach($warehouse_froms as $id => $entry)
                        <option value="{{ $id }}" {{ old('warehouse_from_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse_from'))
                    <span class="text-danger">{{ $errors->first('warehouse_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.warehouse_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="warehouse_to_id">{{ trans('cruds.warehouseTransfer.fields.warehouse_to') }}</label>
                <select class="form-control select2 {{ $errors->has('warehouse_to') ? 'is-invalid' : '' }}" name="warehouse_to_id" id="warehouse_to_id" required>
                    @foreach($warehouse_tos as $id => $entry)
                        <option value="{{ $id }}" {{ old('warehouse_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('warehouse_to'))
                    <span class="text-danger">{{ $errors->first('warehouse_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.warehouse_to_helper') }}</span>
            </div>

            {{-- <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.warehouseTransfer.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="int_lot_id">{{ trans('cruds.warehouseTransfer.fields.int_lot') }}</label>
                <select class="form-control select2 {{ $errors->has('int_lot') ? 'is-invalid' : '' }}" name="int_lot_id" id="int_lot_id" required>
                    @foreach($int_lots as $id => $entry)
                        <option value="{{ $id }}" {{ old('int_lot_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('int_lot'))
                    <span class="text-danger">{{ $errors->first('int_lot') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.int_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.warehouseTransfer.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.quantity_helper') }}</span>
            </div> --}}


            <div class="form-group">
                <div class="row col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.receiptNote.fields.product') }}</th>
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
                                        @foreach ($products as $id => $product)
                                            <option value="{{ $id }}">
                                                {{ $product }}
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
                                                {{ $int_lot->product->name }} - {{ $int_lot->int_lot }} ({{$int_lot->quantity}})
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
                <label class="required" for="user_id">{{ trans('cruds.warehouseTransfer.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    <option value="{{ $user->id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user->name }}</option>
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.user_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="user_received_id">{{ trans('cruds.warehouseTransfer.fields.user_received') }}</label>
                <select class="form-control select2 {{ $errors->has('user_received') ? 'is-invalid' : '' }}" name="user_received_id" id="user_received_id" required>
                    @foreach($user_receiveds as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_received_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_received'))
                    <span class="text-danger">{{ $errors->first('user_received') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warehouseTransfer.fields.user_received_helper') }}</span>
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
                                "@foreach ($products as $id => $product)" +
                                    '<option value="{{ $id }}">' +
                                        "{{ $product }}" +
                                    '</option>' +
                                "@endforeach" +
                            '</select>' +
                        '</td>' +
                        '<td>' + 
                            '<select class="form-control form-select {{ $errors->has("int_lots") ? "is-invalid" : "" }}" name="int_lots[]" id="int_lots" required>' +
                                '<option value="">Select One</option>' +
                                "@foreach ($int_lots as $int_lot)" +
                                    '<option value="{{ $int_lot->id }}">' +
                                        "{{ $int_lot->product->name }} {{ $int_lot->int_lot }} ({{ $int_lot->quantity }})" +
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

    </script>
@endsection