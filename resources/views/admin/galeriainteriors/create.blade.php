@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.galeriainterior.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.galeriainteriors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.galeriainterior.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.galeriainterior.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_pantalla_id">{{ trans('cruds.galeriainterior.fields.id_pantalla') }}</label>
                <select class="form-control select2 {{ $errors->has('id_pantalla') ? 'is-invalid' : '' }}" name="id_pantalla_id" id="id_pantalla_id">
                    @foreach($id_pantallas as $id => $entry)
                        <option value="{{ $id }}" {{ old('id_pantalla_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_pantalla'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_pantalla') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.galeriainterior.fields.id_pantalla_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallery_1">{{ trans('cruds.galeriainterior.fields.gallery_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gallery_1') ? 'is-invalid' : '' }}" id="gallery_1-dropzone">
                </div>
                @if($errors->has('gallery_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gallery_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.galeriainterior.fields.gallery_1_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.gallery1Dropzone = {
    url: '{{ route('admin.galeriainteriors.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="gallery_1"]').remove()
      $('form').append('<input type="hidden" name="gallery_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="gallery_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($galeriainterior) && $galeriainterior->gallery_1)
      var file = {!! json_encode($galeriainterior->gallery_1) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="gallery_1" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection