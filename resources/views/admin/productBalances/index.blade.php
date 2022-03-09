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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductBalance">
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
                <tbody>
                    @foreach($productBalances as $key => $productBalance)
                        <tr data-entry-id="{{ $productBalance->id }}">
                            <td>

                            </td>
                            <td>
                                @foreach($productBalance->names as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $productBalance->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $productBalance->balance_optimal->balance_optimal ?? '' }}
                            </td>
                            <td>
                                {{ $productBalance->balance_min->balance_min ?? '' }}
                            </td>
                            <td>
                                {{ $productBalance->balance_max ?? '' }}
                            </td>
                            <td>
                                {{ $productBalance->balance_reserved ?? '' }}
                            </td>
                            <td>
                                @can('product_balance_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-balances.show', $productBalance->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_balance_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-balances.edit', $productBalance->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_balance_delete')
                                    <form action="{{ route('admin.product-balances.destroy', $productBalance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_balance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-balances.massDestroy') }}",
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
    order: [[ 4, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-ProductBalance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
