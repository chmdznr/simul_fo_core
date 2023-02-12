@extends('layouts.admin')
@section('content')
@can('site_point_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.site-points.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sitePoint.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SitePoint', 'route' => 'admin.site-points.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sitePoint.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SitePoint">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.sid') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.site_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.latitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.longitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.kode_pos') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.kelurahan') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.kecamatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.kabupaten') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.provinsi') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.region') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.area') }}
                    </th>
                    <th>
                        {{ trans('cruds.sitePoint.fields.cluster') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('site_point_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.site-points.massDestroy') }}",
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
    ajax: "{{ route('admin.site-points.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'sid', name: 'sid' },
{ data: 'site_name', name: 'site_name' },
{ data: 'latitude', name: 'latitude' },
{ data: 'longitude', name: 'longitude' },
{ data: 'address', name: 'address' },
{ data: 'kode_pos', name: 'kode_pos' },
{ data: 'kelurahan', name: 'kelurahan' },
{ data: 'kecamatan', name: 'kecamatan' },
{ data: 'kabupaten', name: 'kabupaten' },
{ data: 'provinsi', name: 'provinsi' },
{ data: 'region', name: 'region' },
{ data: 'area', name: 'area' },
{ data: 'cluster', name: 'cluster' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SitePoint').DataTable(dtOverrideGlobals);
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