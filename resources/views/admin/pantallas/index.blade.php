@extends('layouts.admin')
@section('content')
@can('pantalla_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pantallas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pantalla.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pantalla.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Pantalla">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.name_screen') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.url_tour') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.brochure') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.plants') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.cod_qr') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.link_video') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.id_gallery_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.id_gallery_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.caracteristica_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.caracteristica_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.pantalla.fields.mapa') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pantallas as $key => $pantalla)
                        <tr data-entry-id="{{ $pantalla->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pantalla->id ?? '' }}
                            </td>
                            <td>
                                {{ $pantalla->name_screen ?? '' }}
                            </td>
                            <td>
                                {{ $pantalla->url_tour ?? '' }}
                            </td>
                            <td>
                                {{ $pantalla->brochure ?? '' }}
                            </td>
                            <td>
                                {{ $pantalla->plants ?? '' }}
                            </td>
                            <td>
                                @if($pantalla->cod_qr)
                                    <a href="{{ $pantalla->cod_qr->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $pantalla->link_video ?? '' }}
                            </td>
                            <td>
                                @foreach($pantalla->id_gallery_1s as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($pantalla->id_gallery_2s as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($pantalla->logo)
                                    <a href="{{ $pantalla->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $pantalla->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($pantalla->caracteristica_1)
                                    <a href="{{ $pantalla->caracteristica_1->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $pantalla->caracteristica_1->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($pantalla->caracteristica_2)
                                    <a href="{{ $pantalla->caracteristica_2->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $pantalla->caracteristica_2->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $pantalla->mapa ?? '' }}
                            </td>
                            <td>
                                @can('pantalla_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pantallas.show', $pantalla->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pantalla_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pantallas.edit', $pantalla->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pantalla_delete')
                                    <form action="{{ route('admin.pantallas.destroy', $pantalla->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pantalla_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pantallas.massDestroy') }}",
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
  let table = $('.datatable-Pantalla:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection