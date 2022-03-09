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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BillMaterial">
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
                <tbody>
                    @foreach($billMaterials as $key => $billMaterial)
                        <tr data-entry-id="{{ $billMaterial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $billMaterial->name ?? '' }}
                            </td>
                            <td>
                                {{ $billMaterial->for_product->name ?? '' }}
                            </td>
                            <td>
                                {{ $billMaterial->for_product->price ?? '' }}
                            </td>
                            <td>
                                @foreach($billMaterial->ingridients as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $billMaterial->price ?? '' }}
                            </td>
                            <td>
                                {{ $billMaterial->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $billMaterial->coefficient ?? '' }}
                            </td>
                            <td>
                                {{ $billMaterial->total ?? '' }}
                            </td>
                            <td>
                                @can('bill_material_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bill-materials.show', $billMaterial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bill_material_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bill-materials.edit', $billMaterial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bill_material_delete')
                                    <form action="{{ route('admin.bill-materials.destroy', $billMaterial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bill_material_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bill-materials.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-BillMaterial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
