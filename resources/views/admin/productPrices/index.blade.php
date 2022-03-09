@extends('layouts.admin')
@section('content')
@can('product_price_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-prices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productPrice.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productPrice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductPrice">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productPrice.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productPrice.fields.bom') }}
                        </th>
                        <th>
                            {{ trans('cruds.billMaterial.fields.total') }}
                        </th>
                        <th>
                            {{ trans('cruds.productPrice.fields.quantity') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productPrices as $key => $productPrice)
                        <tr data-entry-id="{{ $productPrice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productPrice->id ?? '' }}
                            </td>
                            <td>
                                {{ $productPrice->bom->name ?? '' }}
                            </td>
                            <td>
                                {{ $productPrice->bom->total ?? '' }}
                            </td>
                            <td>
                                {{ $productPrice->quantity ?? '' }}
                            </td>
                            <td>
                                @can('product_price_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-prices.show', $productPrice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_price_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-prices.edit', $productPrice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_price_delete')
                                    <form action="{{ route('admin.product-prices.destroy', $productPrice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_price_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-prices.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-ProductPrice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
