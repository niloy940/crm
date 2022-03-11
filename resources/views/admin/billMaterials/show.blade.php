@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billMaterial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.id') }}
                        </th>
                        <td>
                            {{ $billMaterial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.name') }}
                        </th>
                        <td>
                            {{ $billMaterial->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.for_product') }}
                        </th>
                        <td>
                            {{ $billMaterial->for_product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.ingridients') }}
                        </th>
                        <td>
                            @foreach($billMaterial->ingridients as $key => $ingridients)
                                <span class="label label-info">{{ $ingridients->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.price') }}
                        </th>
                        <td>
                            {{ $billMaterial->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.quantity') }}
                        </th>
                        <td>
                            {{ $billMaterial->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.other_expenses') }}
                        </th>
                        <td>
                            {{ $billMaterial->other_expenses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.coefficient') }}
                        </th>
                        <td>
                            {{ $billMaterial->coefficient }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billMaterial.fields.total') }}
                        </th>
                        <td>
                            {{ $billMaterial->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-materials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection