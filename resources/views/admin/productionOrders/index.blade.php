@extends('layouts.admin')
@section('content')
@can('production_order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.production-orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productionOrder.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productionOrder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductionOrder">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productionOrder.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productionOrder.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.productionOrder.fields.due_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.productionOrder.fields.recommended') }}
                        </th>
                        <th>
                            {{ trans('cruds.productionOrder.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productionOrders as $key => $productionOrder)
                        <tr data-entry-id="{{ $productionOrder->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productionOrder->id ?? '' }}
                            </td>
                            <td>
                                {{ $productionOrder->client->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $productionOrder->due_date ?? '' }}
                            </td>
                            <td>
                                {{ $productionOrder->recommended ?? '' }}
                            </td>
                            <td>
                                {{ $productionOrder->created_at ?? '' }}
                            </td>
                            <td>
                                @can('production_order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.production-orders.show', $productionOrder->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('production_order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.production-orders.edit', $productionOrder->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('production_order_delete')
                                    <form action="{{ route('admin.production-orders.destroy', $productionOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('production_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.production-orders.massDestroy') }}",
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
    order: [[ 5, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-ProductionOrder:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection