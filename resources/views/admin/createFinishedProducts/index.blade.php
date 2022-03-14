@extends('layouts.admin')
@section('content')
@can('create_finished_product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.create-finished-products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.createFinishedProduct.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.createFinishedProduct.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CreateFinishedProduct">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.shift') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.created_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.expiry_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.createFinishedProduct.fields.processing_spent') }}
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
@can('create_finished_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.create-finished-products.massDestroy') }}",
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
    ajax: "{{ route('admin.create-finished-products.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'shift', name: 'shift' },
{ data: 'product', name: 'products.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'user_name', name: 'user.name' },
{ data: 'created_at', name: 'created_at' },
{ data: 'expiry_date', name: 'expiry_date' },
{ data: 'processing_spent_name', name: 'processing_spent.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-CreateFinishedProduct').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection