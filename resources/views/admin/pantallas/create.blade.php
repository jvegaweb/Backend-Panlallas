@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pantalla.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pantallas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_screen">{{ trans('cruds.pantalla.fields.name_screen') }}</label>
                <input class="form-control {{ $errors->has('name_screen') ? 'is-invalid' : '' }}" type="text" name="name_screen" id="name_screen" value="{{ old('name_screen', '') }}" required>
                @if($errors->has('name_screen'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_screen') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.name_screen_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="features">{{ trans('cruds.pantalla.fields.features') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('features') ? 'is-invalid' : '' }}" name="features" id="features">{!! old('features') !!}</textarea>
                @if($errors->has('features'))
                    <div class="invalid-feedback">
                        {{ $errors->first('features') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.features_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url_tour">{{ trans('cruds.pantalla.fields.url_tour') }}</label>
                <input class="form-control {{ $errors->has('url_tour') ? 'is-invalid' : '' }}" type="text" name="url_tour" id="url_tour" value="{{ old('url_tour', '') }}">
                @if($errors->has('url_tour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url_tour') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.url_tour_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brochure">{{ trans('cruds.pantalla.fields.brochure') }}</label>
                <input class="form-control {{ $errors->has('brochure') ? 'is-invalid' : '' }}" type="text" name="brochure" id="brochure" value="{{ old('brochure', '') }}">
                @if($errors->has('brochure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brochure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.brochure_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plants">{{ trans('cruds.pantalla.fields.plants') }}</label>
                <input class="form-control {{ $errors->has('plants') ? 'is-invalid' : '' }}" type="text" name="plants" id="plants" value="{{ old('plants', '') }}">
                @if($errors->has('plants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('plants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.plants_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cod_qr">{{ trans('cruds.pantalla.fields.cod_qr') }}</label>
                <div class="needsclick dropzone {{ $errors->has('cod_qr') ? 'is-invalid' : '' }}" id="cod_qr-dropzone">
                </div>
                @if($errors->has('cod_qr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cod_qr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.cod_qr_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_video">{{ trans('cruds.pantalla.fields.link_video') }}</label>
                <input class="form-control {{ $errors->has('link_video') ? 'is-invalid' : '' }}" type="text" name="link_video" id="link_video" value="{{ old('link_video', '') }}">
                @if($errors->has('link_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.link_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_gallery_1s">{{ trans('cruds.pantalla.fields.id_gallery_1') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('id_gallery_1s') ? 'is-invalid' : '' }}" name="id_gallery_1s[]" id="id_gallery_1s" multiple>
                    @foreach($id_gallery_1s as $id => $id_gallery_1)
                        <option value="{{ $id }}" {{ in_array($id, old('id_gallery_1s', [])) ? 'selected' : '' }}>{{ $id_gallery_1 }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_gallery_1s'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_gallery_1s') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.id_gallery_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_gallery_2s">{{ trans('cruds.pantalla.fields.id_gallery_2') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('id_gallery_2s') ? 'is-invalid' : '' }}" name="id_gallery_2s[]" id="id_gallery_2s" multiple>
                    @foreach($id_gallery_2s as $id => $id_gallery_2)
                        <option value="{{ $id }}" {{ in_array($id, old('id_gallery_2s', [])) ? 'selected' : '' }}>{{ $id_gallery_2 }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_gallery_2s'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_gallery_2s') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.id_gallery_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.pantalla.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="caracteristica_1">{{ trans('cruds.pantalla.fields.caracteristica_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('caracteristica_1') ? 'is-invalid' : '' }}" id="caracteristica_1-dropzone">
                </div>
                @if($errors->has('caracteristica_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caracteristica_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.caracteristica_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="caracteristica_2">{{ trans('cruds.pantalla.fields.caracteristica_2') }}</label>
                <div class="needsclick dropzone {{ $errors->has('caracteristica_2') ? 'is-invalid' : '' }}" id="caracteristica_2-dropzone">
                </div>
                @if($errors->has('caracteristica_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caracteristica_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.caracteristica_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mapa">{{ trans('cruds.pantalla.fields.mapa') }}</label>
                <input class="form-control {{ $errors->has('mapa') ? 'is-invalid' : '' }}" type="text" name="mapa" id="mapa" value="{{ old('mapa', '') }}">
                @if($errors->has('mapa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mapa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pantalla.fields.mapa_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.pantallas.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $pantalla->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.codQrDropzone = {
    url: '{{ route('admin.pantallas.storeMedia') }}',
    maxFilesize: 4, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').find('input[name="cod_qr"]').remove()
      $('form').append('<input type="hidden" name="cod_qr" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cod_qr"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pantalla) && $pantalla->cod_qr)
      var file = {!! json_encode($pantalla->cod_qr) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cod_qr" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.pantallas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pantalla) && $pantalla->logo)
      var file = {!! json_encode($pantalla->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.caracteristica1Dropzone = {
    url: '{{ route('admin.pantallas.storeMedia') }}',
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
      $('form').find('input[name="caracteristica_1"]').remove()
      $('form').append('<input type="hidden" name="caracteristica_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="caracteristica_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pantalla) && $pantalla->caracteristica_1)
      var file = {!! json_encode($pantalla->caracteristica_1) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="caracteristica_1" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.caracteristica2Dropzone = {
    url: '{{ route('admin.pantallas.storeMedia') }}',
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
      $('form').find('input[name="caracteristica_2"]').remove()
      $('form').append('<input type="hidden" name="caracteristica_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="caracteristica_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pantalla) && $pantalla->caracteristica_2)
      var file = {!! json_encode($pantalla->caracteristica_2) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="caracteristica_2" value="' + file.file_name + '">')
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