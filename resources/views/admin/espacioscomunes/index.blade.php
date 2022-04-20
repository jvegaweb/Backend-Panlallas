@extends('layouts.admin')
@section('content')
@can('espacioscomune_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.espacioscomunes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.espacioscomune.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.espacioscomune.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Espacioscomune">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.espacioscomune.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.espacioscomune.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.espacioscomune.fields.id_pantalla') }}
                        </th>
                        <th>
                            {{ trans('cruds.espacioscomune.fields.gallery_2') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($espacioscomunes as $key => $espacioscomune)
                        <tr data-entry-id="{{ $espacioscomune->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $espacioscomune->id ?? '' }}
                            </td>
                            <td>
                                {{ $espacioscomune->name ?? '' }}
                            </td>
                            <td>
                                {{ $espacioscomune->id_pantalla->name_screen ?? '' }}
                            </td>
                            <td>
                                @if($espacioscomune->gallery_2)
                                    <a href="{{ $espacioscomune->gallery_2->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $espacioscomune->gallery_2->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('espacioscomune_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.espacioscomunes.show', $espacioscomune->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('espacioscomune_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.espacioscomunes.edit', $espacioscomune->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('espacioscomune_delete')
                                    <form action="{{ route('admin.espacioscomunes.destroy', $espacioscomune->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('espacioscomune_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.espacioscomunes.massDestroy') }}",
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
  let table = $('.datatable-Espacioscomune:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection