@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pantalla.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pantallas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.id') }}
                        </th>
                        <td>
                            {{ $pantalla->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.name_screen') }}
                        </th>
                        <td>
                            {{ $pantalla->name_screen }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.features') }}
                        </th>
                        <td>
                            {!! $pantalla->features !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.url_tour') }}
                        </th>
                        <td>
                            {{ $pantalla->url_tour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.brochure') }}
                        </th>
                        <td>
                            {{ $pantalla->brochure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.plants') }}
                        </th>
                        <td>
                            {{ $pantalla->plants }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.cod_qr') }}
                        </th>
                        <td>
                            @if($pantalla->cod_qr)
                                <a href="{{ $pantalla->cod_qr->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.link_video') }}
                        </th>
                        <td>
                            {{ $pantalla->link_video }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.id_gallery_1') }}
                        </th>
                        <td>
                            @foreach($pantalla->id_gallery_1s as $key => $id_gallery_1)
                                <span class="label label-info">{{ $id_gallery_1->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.id_gallery_2') }}
                        </th>
                        <td>
                            @foreach($pantalla->id_gallery_2s as $key => $id_gallery_2)
                                <span class="label label-info">{{ $id_gallery_2->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.logo') }}
                        </th>
                        <td>
                            @if($pantalla->logo)
                                <a href="{{ $pantalla->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pantalla->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.caracteristica_1') }}
                        </th>
                        <td>
                            @if($pantalla->caracteristica_1)
                                <a href="{{ $pantalla->caracteristica_1->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pantalla->caracteristica_1->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.caracteristica_2') }}
                        </th>
                        <td>
                            @if($pantalla->caracteristica_2)
                                <a href="{{ $pantalla->caracteristica_2->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $pantalla->caracteristica_2->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pantalla.fields.mapa') }}
                        </th>
                        <td>
                            {{ $pantalla->mapa }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pantallas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#screen_clientes" role="tab" data-toggle="tab">
                {{ trans('cruds.cliente.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="screen_clientes">
            @includeIf('admin.pantallas.relationships.screenClientes', ['clientes' => $pantalla->screenClientes])
        </div>
    </div>
</div>

@endsection