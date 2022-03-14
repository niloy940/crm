@extends('layouts.admin')
@section('content')
@can('production_spent_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.production-spents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productionSpent.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productionSpent.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductionSpent">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.shift') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.date_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.ingridients') }}
                    </th>
                    <th>
                        {{ trans('cruds.productionSpent.fields.quantity_ing') }}
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
@can('production_spent_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.production-spents.massDestroy') }}",
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
    ajax: "{{ route('admin.production-spents.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'product', name: 'products.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'shift', name: 'shift' },
{ data: 'date_time', name: 'date_time' },
{ data: 'ingridients_name', name: 'ingridients.name' },
{ data: 'quantity_ing', name: 'quantity_ing' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ProductionSpent').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection