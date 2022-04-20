@extends('layouts.admin')
@section('content')
@can('galeriainterior_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.galeriainteriors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.galeriainterior.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.galeriainterior.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Galeriainterior">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.id_pantalla') }}
                        </th>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.gallery_1') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galeriainteriors as $key => $galeriainterior)
                        <tr data-entry-id="{{ $galeriainterior->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $galeriainterior->id ?? '' }}
                            </td>
                            <td>
                                {{ $galeriainterior->name ?? '' }}
                            </td>
                            <td>
                                {{ $galeriainterior->id_pantalla->name_screen ?? '' }}
                            </td>
                            <td>
                                @if($galeriainterior->gallery_1)
                                    <a href="{{ $galeriainterior->gallery_1->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $galeriainterior->gallery_1->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('galeriainterior_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.galeriainteriors.show', $galeriainterior->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('galeriainterior_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.galeriainteriors.edit', $galeriainterior->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('galeriainterior_delete')
                                    <form action="{{ route('admin.galeriainteriors.destroy', $galeriainterior->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('galeriainterior_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.galeriainteriors.massDestroy') }}",
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
  let table = $('.datatable-Galeriainterior:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection