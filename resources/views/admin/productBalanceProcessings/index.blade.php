@extends('layouts.admin')
@section('content')
@can('product_balance_processing_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-balance-processings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productBalanceProcessing.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productBalanceProcessing.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductBalanceProcessing">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.halfproduct') }}
                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_min') }}
                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_optimal') }}
                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_max') }}
                        </th>
                        <th>
                            {{ trans('cruds.productBalanceProcessing.fields.balance_reserved') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($productBalanceProcessings as $key => $productBalanceProcessing)
                        <tr data-entry-id="{{ $productBalanceProcessing->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productBalanceProcessing->halfproduct->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $productBalanceProcessing->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $productBalanceProcessing->balance_min->balance_min ?? '' }}
                            </td>
                            <td>
                                {{ $productBalanceProcessing->balance_optimal->balance_optimal ?? '' }}
                            </td>
                            <td>
                                {{ $productBalanceProcessing->balance_max ?? '' }}
                            </td>
                            <td>
                                {{ $productBalanceProcessing->balance_reserved ?? '' }}
                            </td>
                            <td>
                                @can('product_balance_processing_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-balance-processings.show', $productBalanceProcessing->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_balance_processing_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-balance-processings.edit', $productBalanceProcessing->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_balance_processing_delete')
                                    <form action="{{ route('admin.product-balance-processings.destroy', $productBalanceProcessing->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach --}}

                    @foreach($half_product_makes as $key => $half_product_make)
                        <tr data-entry-id="{{ $half_product_make->halfProduct->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $half_product_make->halfproduct->name ?? '' }}
                            </td>
                            <td>
                                {{ $half_product_make->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $half_product_make->balance_min->balance_min ?? '' }}
                            </td>
                            <td>
                                {{ $half_product_make->balance_optimal->balance_optimal ?? '' }}
                            </td>
                            <td>
                                {{ $half_product_make->balance_max ?? '' }}
                            </td>
                            <td>
                                {{ $half_product_make->balance_reserved ?? '' }}
                            </td>
                            <td>
                                @can('product_balance_processing_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-balance-processings.show', $half_product_make->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_balance_processing_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-balance-processings.edit', $half_product_make->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_balance_processing_delete')
                                    <form action="{{ route('admin.product-balance-processings.destroy', $half_product_make->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_balance_processing_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-balance-processings.massDestroy') }}",
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
    order: [[ 3, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-ProductBalanceProcessing:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection