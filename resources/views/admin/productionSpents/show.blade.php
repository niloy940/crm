@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productionSpent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.production-spents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.id') }}
                        </th>
                        <td>
                            {{ $productionSpent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.name') }}
                        </th>
                        <td>
                            {{ $productionSpent->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.product') }}
                        </th>
                        <td>
                            @foreach($productionSpent->products as $key => $product)
                                <span class="label label-info">{{ $product->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.quantity') }}
                        </th>
                        <td>
                            {{ $productionSpent->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.shift') }}
                        </th>
                        <td>
                            {{ App\Models\ProductionSpent::SHIFT_SELECT[$productionSpent->shift] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.date_time') }}
                        </th>
                        <td>
                            {{ $productionSpent->date_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.ingridients') }}
                        </th>
                        <td>
                            {{ $productionSpent->ingridients->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productionSpent.fields.quantity_ing') }}
                        </th>
                        <td>
                            {{ $productionSpent->quantity_ing }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.production-spents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection