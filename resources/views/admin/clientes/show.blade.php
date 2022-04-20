@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cliente.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.id') }}
                        </th>
                        <td>
                            {{ $cliente->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.name') }}
                        </th>
                        <td>
                            {{ $cliente->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.rut') }}
                        </th>
                        <td>
                            {{ $cliente->rut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.email') }}
                        </th>
                        <td>
                            {{ $cliente->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.address') }}
                        </th>
                        <td>
                            {{ $cliente->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.city') }}
                        </th>
                        <td>
                            {{ $cliente->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.phone') }}
                        </th>
                        <td>
                            {{ $cliente->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cliente.fields.screen') }}
                        </th>
                        <td>
                            @foreach($cliente->screens as $key => $screen)
                                <span class="label label-info">{{ $screen->name_screen }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clientes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection