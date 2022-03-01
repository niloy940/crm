@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pdfInvoice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pdf-invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.id') }}
                        </th>
                        <td>
                            {{ $pdfInvoice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.customer') }}
                        </th>
                        <td>
                            {{ $pdfInvoice->customer->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\PdfInvoice::TYPE_SELECT[$pdfInvoice->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\PdfInvoice::STATUS_SELECT[$pdfInvoice->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.products') }}
                        </th>
                        <td>
                            @foreach($pdfInvoice->products as $key => $products)
                                <span class="label label-info">{{ $products->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.discount') }}
                        </th>
                        <td>
                            {{ $pdfInvoice->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.pay_until') }}
                        </th>
                        <td>
                            {{ $pdfInvoice->pay_until }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.note') }}
                        </th>
                        <td>
                            {{ $pdfInvoice->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pdf-invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection