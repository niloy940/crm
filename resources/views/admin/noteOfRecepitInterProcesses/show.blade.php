@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.noteOfRecepitInterProcess.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.note-of-recepit-inter-processes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.product') }}
                        </th>
                        <td>
                            @foreach($noteOfRecepitInterProcess->products as $key => $product)
                                <span class="label label-info">{{ $product->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.int_lot') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->int_lot->int_lot ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.quantity') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.warehouse') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->warehouse->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.qc') }}
                        </th>
                        <td>
                            {{ App\Models\NoteOfRecepitInterProcess::QC_SELECT[$noteOfRecepitInterProcess->qc] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.conditions') }}
                        </th>
                        <td>
                            {{ App\Models\NoteOfRecepitInterProcess::CONDITIONS_SELECT[$noteOfRecepitInterProcess->conditions] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.shift') }}
                        </th>
                        <td>
                            {{ App\Models\NoteOfRecepitInterProcess::SHIFT_SELECT[$noteOfRecepitInterProcess->shift] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.date') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.issuer') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->issuer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.received_by') }}
                        </th>
                        <td>
                            {{ $noteOfRecepitInterProcess->received_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noteOfRecepitInterProcess.fields.print') }}
                        </th>
                        <td>
                            {{ App\Models\NoteOfRecepitInterProcess::PRINT_SELECT[$noteOfRecepitInterProcess->print] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.note-of-recepit-inter-processes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection