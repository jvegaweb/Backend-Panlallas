@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.galeriainterior.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.galeriainteriors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.id') }}
                        </th>
                        <td>
                            {{ $galeriainterior->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.name') }}
                        </th>
                        <td>
                            {{ $galeriainterior->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.id_pantalla') }}
                        </th>
                        <td>
                            {{ $galeriainterior->id_pantalla->name_screen ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.galeriainterior.fields.gallery_1') }}
                        </th>
                        <td>
                            @if($galeriainterior->gallery_1)
                                <a href="{{ $galeriainterior->gallery_1->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $galeriainterior->gallery_1->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.galeriainteriors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection