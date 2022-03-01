@extends('layouts.admin')
@section('content')
@can('half_product_make_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.half-product-makes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.halfProductMake.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.halfProductMake.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-HalfProductMake">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.halfproduct') }}
                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.ingridients') }}
                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.int_lot') }}
                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.made_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.halfProductMake.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($half_products as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($products_lists as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($receipt_notes as $key => $item)
                                    <option value="{{ $item->int_lot }}">{{ $item->int_lot }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($halfProductMakes as $key => $halfProductMake)
                        <tr data-entry-id="{{ $halfProductMake->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $halfProductMake->halfproduct->name ?? '' }}
                            </td>
                            <td>
                                @foreach($halfProductMake->ingridients as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($halfProductMake->int_lots as $key => $item)
                                    <span class="badge badge-info">{{ $item->int_lot }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $halfProductMake->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $halfProductMake->made_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $halfProductMake->created_at ?? '' }}
                            </td>
                            <td>
                                @can('half_product_make_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.half-product-makes.show', $halfProductMake->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('half_product_make_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.half-product-makes.edit', $halfProductMake->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('half_product_make_delete')
                                    <form action="{{ route('admin.half-product-makes.destroy', $halfProductMake->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('half_product_make_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.half-product-makes.massDestroy') }}",
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
    order: [[ 6, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-HalfProductMake:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection