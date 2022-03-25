@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productionSpent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.production-spents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productionSpent.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.name_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.productionSpent.fields.product') }}</label>
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
                <span class="help-block">{{ trans('cruds.productionSpent.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quantity">{{ trans('cruds.productionSpent.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.001" required>
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.quantity_helper') }}</span>
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
                                        <option value="">Select One</option>
                                        @foreach ($half_product_makes as $half_product_make)
                                           <option value="{{ $half_product_make->int_lot }}">
                                                {{ $half_product_make->halfProduct->name }} - {{ $half_product_make->int_lot }} ({{$half_product_make->quantity}})
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
                <label class="required">{{ trans('cruds.productionSpent.fields.shift') }}</label>
                <select class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" name="shift" id="shift" required>
                    <option value disabled {{ old('shift', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductionSpent::SHIFT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shift', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shift'))
                    <span class="text-danger">{{ $errors->first('shift') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.shift_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_time">{{ trans('cruds.productionSpent.fields.date_time') }}</label>
                <input class="form-control datetime {{ $errors->has('date_time') ? 'is-invalid' : '' }}" type="text" name="date_time" id="date_time" value="{{ old('date_time') }}" required>
                @if($errors->has('date_time'))
                    <span class="text-danger">{{ $errors->first('date_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.date_time_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="ingridients_id">{{ trans('cruds.productionSpent.fields.ingridients') }}</label>
                <select class="form-control select2 {{ $errors->has('ingridients') ? 'is-invalid' : '' }}" name="ingridients_id" id="ingridients_id">
                    @foreach($ingridients as $id => $entry)
                        <option value="{{ $id }}" {{ old('ingridients_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ingridients'))
                    <span class="text-danger">{{ $errors->first('ingridients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.ingridients_helper') }}</span>
            </div> --}}
            {{-- <div class="form-group">
                <label class="required" for="quantity_ing">{{ trans('cruds.productionSpent.fields.quantity_ing') }}</label>
                <input class="form-control {{ $errors->has('quantity_ing') ? 'is-invalid' : '' }}" type="number" name="quantity_ing" id="quantity_ing" value="{{ old('quantity_ing', '') }}" step="0.001" required>
                @if($errors->has('quantity_ing'))
                    <span class="text-danger">{{ $errors->first('quantity_ing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productionSpent.fields.quantity_ing_helper') }}</span>
            </div> --}}
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
                                "@foreach ($half_product_makes as $half_product_make)" +
                                    '<option value="{{ $half_product_make->int_lot }}">' +
                                        "{{ $half_product_make->halfProduct->name }} - {{ $half_product_make->int_lot }} ({{$half_product_make->quantity}})" +
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