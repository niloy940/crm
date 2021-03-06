@extends('layouts.admin')
@section('content')
@can('bill_material_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bill-materials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.billMaterial.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.billMaterial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BillMaterial">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.for_product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productsList.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.ingridients') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.coefficient') }}
                    </th>
                    <th>
                        {{ trans('cruds.billMaterial.fields.total') }}
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
@can('bill_material_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bill-materials.massDestroy') }}",
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
    ajax: "{{ route('admin.bill-materials.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'for_product_name', name: 'for_product.name' },
{ data: 'for_product.price', name: 'for_product.price' },
{ data: 'ingridients', name: 'ingridients.name' },
{ data: 'price', name: 'price' },
{ data: 'quantity', name: 'quantity' },
{ data: 'coefficient', name: 'coefficient' },
{ data: 'total', name: 'total' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-BillMaterial').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection