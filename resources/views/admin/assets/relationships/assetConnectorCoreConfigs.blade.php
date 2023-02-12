@can('core_config_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.core-configs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.coreConfig.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.coreConfig.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-assetConnectorCoreConfigs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.segment_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.alias') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.segment_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.alias') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.splice_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.coreConfig.fields.asset_connector') }}
                        </th>
                        <th>
                            {{ trans('cruds.asset.fields.aid') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coreConfigs as $key => $coreConfig)
                        <tr data-entry-id="{{ $coreConfig->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $coreConfig->id ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->name ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->segment_1->segid ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->segment_1->alias ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->segment_2->segid ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->segment_2->alias ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CoreConfig::SPLICE_TYPE_SELECT[$coreConfig->splice_type] ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->asset_connector->serial_number ?? '' }}
                            </td>
                            <td>
                                {{ $coreConfig->asset_connector->aid ?? '' }}
                            </td>
                            <td>
                                @can('core_config_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.core-configs.show', $coreConfig->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('core_config_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.core-configs.edit', $coreConfig->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('core_config_delete')
                                    <form action="{{ route('admin.core-configs.destroy', $coreConfig->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('core_config_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.core-configs.massDestroy') }}",
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
  let table = $('.datatable-assetConnectorCoreConfigs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection