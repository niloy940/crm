@extends('layouts.admin')
@section('content')
@can('products_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productsList.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ProductsList', 'route' => 'admin.products-lists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productsList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductsList">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productsList.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productsList.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.productsList.fields.warehouse') }}
                        </th>
                        <th>
                            {{ trans('cruds.productsList.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.productsList.fields.balance_max') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productsLists as $key => $productsList)
                        <tr data-entry-id="{{ $productsList->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productsList->id ?? '' }}
                            </td>
                            <td>
                                {{ $productsList->name ?? '' }}
                            </td>
                            <td>
                                {{ $productsList->warehouse->name ?? '' }}
                            </td>
                            <td>
                                {{ $productsList->price ?? '' }}
                            </td>
                            <td>
                                {{ $productsList->balance_max ?? '' }}
                            </td>
                            <td>
                                @can('products_list_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.products-lists.show', $productsList->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('products_list_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.products-lists.edit', $productsList->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('products_list_delete')
                                    <form action="{{ route('admin.products-lists.destroy', $productsList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('products_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products-lists.massDestroy') }}",
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
  let table = $('.datatable-ProductsList:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
