@extends('layouts.admin')
@section('content')
@can('note_of_recepit_inter_process_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.note-of-recepit-inter-processes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.noteOfRecepitInterProcess.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.noteOfRecepitInterProcess.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NoteOfRecepitInterProcess">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.int_lot') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.warehouse') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.shift') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.issuer') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.received_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.print') }}
                    </th>
                    <th>
                        {{ trans('cruds.noteOfRecepitInterProcess.fields.created_at') }}
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
                            @foreach($warehouses_lists as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\NoteOfRecepitInterProcess::SHIFT_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\NoteOfRecepitInterProcess::PRINT_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('note_of_recepit_inter_process_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.note-of-recepit-inter-processes.massDestroy') }}",
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
    ajax: "{{ route('admin.note-of-recepit-inter-processes.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'product', name: 'products.name' },
{ data: 'int_lot_int_lot', name: 'int_lot.int_lot' },
{ data: 'quantity', name: 'quantity' },
{ data: 'warehouse_name', name: 'warehouse.name' },
{ data: 'shift', name: 'shift' },
{ data: 'date', name: 'date' },
{ data: 'issuer_name', name: 'issuer.name' },
{ data: 'received_by_name', name: 'received_by.name' },
{ data: 'print', name: 'print' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 10, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-NoteOfRecepitInterProcess').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection