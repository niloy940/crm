@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.receiptNote.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receipt-notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.client') }}
                        </th>
                        <td>
                            {{ $receiptNote->client->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.product') }}
                        </th>
                        <td>
                            @foreach($receiptNote->products as $key => $product)
                                <span class="label label-info">{{ $product->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.quantity') }}
                        </th>
                        <td>
                            {{ $receiptNote->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.lot') }}
                        </th>
                        <td>
                            {{ $receiptNote->lot }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.int_lot') }}
                        </th>
                        <td>
                            {{ $receiptNote->int_lot }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $receiptNote->expiry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.warehouse') }}
                        </th>
                        <td>
                            {{ $receiptNote->warehouse->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.sector') }}
                        </th>
                        <td>
                            {{ $receiptNote->sector->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.shelf') }}
                        </th>
                        <td>
                            {{ $receiptNote->shelf }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.qc') }}
                        </th>
                        <td>
                            {{ App\Models\ReceiptNote::QC_SELECT[$receiptNote->qc] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.conditions') }}
                        </th>
                        <td>
                            {{ App\Models\ReceiptNote::CONDITIONS_SELECT[$receiptNote->conditions] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.shift') }}
                        </th>
                        <td>
                            {{ App\Models\ReceiptNote::SHIFT_SELECT[$receiptNote->shift] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.date') }}
                        </th>
                        <td>
                            {{ $receiptNote->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.place') }}
                        </th>
                        <td>
                            {{ $receiptNote->place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.driver') }}
                        </th>
                        <td>
                            {{ $receiptNote->driver }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.id_driver') }}
                        </th>
                        <td>
                            {{ $receiptNote->id_driver }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.registration') }}
                        </th>
                        <td>
                            {{ $receiptNote->registration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.issuer') }}
                        </th>
                        <td>
                            {{ $receiptNote->issuer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.receiptNote.fields.print') }}
                        </th>
                        <td>
                            {{ App\Models\ReceiptNote::PRINT_SELECT[$receiptNote->print] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.receipt-notes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection