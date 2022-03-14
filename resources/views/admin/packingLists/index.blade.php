@extends('layouts.admin')
@section('content')
@can('packing_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.packing-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.packingList.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.packingList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PackingList">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.client') }}
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
                        {{ trans('cruds.packingList.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.net_weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.bruto_weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.width') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.height') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.length') }}
                    </th>
                    <th>
                        {{ trans('cruds.packingList.fields.user') }}
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('packing_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.packing-lists.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.packing-lists.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'client_company_name', name: 'client.company_name' },
{ data: 'client.email', name: 'client.email' },
{ data: 'client.phone', name: 'client.phone' },
{ data: 'client.address', name: 'client.address' },
{ data: 'client.tax_no', name: 'client.tax_no' },
{ data: 'product_name', name: 'product.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'net_weight', name: 'net_weight' },
{ data: 'bruto_weight', name: 'bruto_weight' },
{ data: 'width', name: 'width' },
{ data: 'height', name: 'height' },
{ data: 'length', name: 'length' },
{ data: 'user_name', name: 'user.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-PackingList').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection