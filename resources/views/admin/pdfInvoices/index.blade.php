@extends('layouts.admin')
@section('content')
@can('pdf_invoice_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pdf-invoices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pdfInvoice.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pdfInvoice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PdfInvoice">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.crmCustomer.fields.tax_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.products') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.discount') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.pay_until') }}
                        </th>
                        <th>
                            {{ trans('cruds.pdfInvoice.fields.note') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($crm_customers as $key => $item)
                                    <option value="{{ $item->company_name }}">{{ $item->company_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\PdfInvoice::TYPE_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\PdfInvoice::STATUS_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($products_lists as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pdfInvoices as $key => $pdfInvoice)
                        <tr data-entry-id="{{ $pdfInvoice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pdfInvoice->id ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->customer->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->customer->email ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->customer->phone ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->customer->address ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->customer->tax_no ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PdfInvoice::TYPE_SELECT[$pdfInvoice->type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PdfInvoice::STATUS_SELECT[$pdfInvoice->status] ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->created_at ?? '' }}
                            </td>
                            <td>
                                @foreach($pdfInvoice->products as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $pdfInvoice->discount ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->pay_until ?? '' }}
                            </td>
                            <td>
                                {{ $pdfInvoice->note ?? '' }}
                            </td>
                            <td>
                                @can('pdf_invoice_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pdf-invoices.show', $pdfInvoice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pdf_invoice_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pdf-invoices.edit', $pdfInvoice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pdf_invoice_delete')
                                    <form action="{{ route('admin.pdf-invoices.destroy', $pdfInvoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pdf_invoice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pdf-invoices.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 9, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-PdfInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection