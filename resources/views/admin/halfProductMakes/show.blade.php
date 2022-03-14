@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.halfProductMake.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.half-product-makes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.halfproduct') }}
                        </th>
                        <td>
                            {{ $halfProductMake->halfproduct->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.ingridients') }}
                        </th>
                        <td>
                            @foreach($halfProductMake->ingridients as $key => $ingridients)
                                <span class="label label-info">{{ $ingridients->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.quantity') }}
                        </th>
                        <td>
                            {{ $halfProductMake->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.int_lot') }}
                        </th>
                        <td>
                            @foreach($halfProductMake->int_lots as $key => $int_lot)
                                <span class="label label-info">{{ $int_lot->int_lot }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.made_by') }}
                        </th>
                        <td>
                            {{ $halfProductMake->made_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.half-product-makes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection