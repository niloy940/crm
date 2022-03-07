@extends('layouts.admin')
@section('content')
@can('product_balance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-balances.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productBalance.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productBalance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductBalance">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.balance_optimal') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.balance_min') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.balance_max') }}
                    </th>
                    <th>
                        {{ trans('cruds.productBalance.fields.balance_reserved') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
@can('product_balance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-balances.massDestroy') }}",
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
    ajax: "{{ route('admin.product-balances.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'names.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'balance_optimal_balance_optimal', name: 'balance_optimal.balance_optimal' },
{ data: 'balance_min_balance_min', name: 'balance_min.balance_min' },
{ data: 'balance_max', name: 'balance_max' },
{ data: 'balance_reserved', name: 'balance_reserved' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 4, 'asc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ProductBalance').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection