@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cliente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clientes.update", [$cliente->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.cliente.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $cliente->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rut">{{ trans('cruds.cliente.fields.rut') }}</label>
                <input class="form-control {{ $errors->has('rut') ? 'is-invalid' : '' }}" type="number" name="rut" id="rut" value="{{ old('rut', $cliente->rut) }}" step="1" required>
                @if($errors->has('rut'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rut') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.rut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.cliente.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.cliente.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $cliente->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.cliente.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $cliente->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.cliente.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $cliente->phone) }}" step="1" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="screens">{{ trans('cruds.cliente.fields.screen') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('screens') ? 'is-invalid' : '' }}" name="screens[]" id="screens" multiple>
                    @foreach($screens as $id => $screen)
                        <option value="{{ $id }}" {{ (in_array($id, old('screens', [])) || $cliente->screens->contains($id)) ? 'selected' : '' }}>{{ $screen }}</option>
                    @endforeach
                </select>
                @if($errors->has('screens'))
                    <div class="invalid-feedback">
                        {{ $errors->first('screens') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cliente.fields.screen_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection