@can('segment_connected_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.segment-connecteds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.segmentConnected.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.segmentConnected.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-sitePoint2SegmentConnecteds">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.segid') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.alias') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.site_point_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.sitePoint.fields.site_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.site_point_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.sitePoint.fields.site_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.total_core') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($segmentConnecteds as $key => $segmentConnected)
                        <tr data-entry-id="{{ $segmentConnected->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $segmentConnected->id ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->segid ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->alias ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->site_point_1->sid ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->site_point_1->site_name ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->site_point_2->sid ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->site_point_2->site_name ?? '' }}
                            </td>
                            <td>
                                {{ $segmentConnected->total_core ?? '' }}
                            </td>
                            <td>
                                @can('segment_connected_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.segment-connecteds.show', $segmentConnected->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('segment_connected_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.segment-connecteds.edit', $segmentConnected->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('segment_connected_delete')
                                    <form action="{{ route('admin.segment-connecteds.destroy', $segmentConnected->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('segment_connected_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.segment-connecteds.massDestroy') }}",
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
  let table = $('.datatable-sitePoint2SegmentConnecteds:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection