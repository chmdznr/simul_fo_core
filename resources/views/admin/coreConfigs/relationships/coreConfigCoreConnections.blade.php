@can('core_connection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.core-connections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.coreConnection.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.coreConnection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-coreConfigCoreConnections">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.coreConnection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_config') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.splice_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_number_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_number_2') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coreConnections as $key => $coreConnection)
                        <tr data-entry-id="{{ $coreConnection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $coreConnection->id ?? '' }}
                            </td>
                            <td>
                                {{ $coreConnection->core_config->name ?? '' }}
                            </td>
                            <td>
                                @if($coreConnection->core_config)
                                    {{ $coreConnection->core_config::SPLICE_TYPE_SELECT[$coreConnection->core_config->splice_type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $coreConnection->core_number_1 ?? '' }}
                            </td>
                            <td>
                                {{ $coreConnection->core_number_2 ?? '' }}
                            </td>
                            <td>
                                @can('core_connection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.core-connections.show', $coreConnection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('core_connection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.core-connections.edit', $coreConnection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('core_connection_delete')
                                    <form action="{{ route('admin.core-connections.destroy', $coreConnection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('core_connection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.core-connections.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-coreConfigCoreConnections:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection