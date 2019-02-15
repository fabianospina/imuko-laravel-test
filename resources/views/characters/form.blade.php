@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Personaje</div>

                <div class="card-body">

                  <form method="POST" action="{{ route('save_new_character') }}" enctype="multipart/form-data" >
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                          <div class="col-md-6">
                              <select id="name" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" autofocus>
                                <option value=""></option>
                                <option value="Doña">Doña</option>
                                <option value="Don">Don</option>
                                <option value="Sr">Sr</option>
                                <option value="Srta">Srta</option>
                              </select>

                              @if ($errors->has('title'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                          <div class="col-md-6">
                              <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="{{ old('image') }}" required>

                              @if ($errors->has('image'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('image') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="flat" class="col-md-4 col-form-label text-md-right">{{ __('Apartamento') }}</label>

                          <div class="col-md-6">
                              <input id="flat" type="text" class="form-control{{ $errors->has('flat') ? ' is-invalid' : '' }}" name="flat" value="{{ old('flat') }}" >

                              @if ($errors->has('flat'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('flat') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="nicknames" class="col-md-4 col-form-label text-md-right">{{ __('Apodo(s)') }}</label>

                          <div class="col-md-6">
                              <input type="text" value="" id="nicknames" name="nicknames" value="{{ old('nicknames') }}">

                              <div class="margin-top-10">
                                  <a href="javascript:;" class="btn btn-default" id="nicknames_add">{{ __("AGREGAR APODO") }}</a>
                              </div>

                              @if ($errors->has('nicknames'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('nicknames') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                          <div class="col-md-6">
                              <textarea id="description" type="password" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required>{{ old('description') }}</textarea>

                              @if ($errors->has('description'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Guardar') }}
                              </button>
                              <a href="{{ route('home') }}" class="btn btn-primary btn-warning">
                                  {{ __('Cancelar') }}
                              </a>
                          </div>
                      </div>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<link href="/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<script src="/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script>
$(function() {
  $(document).ready(function(){
    var elt = $('#nicknames');

    elt.tagsinput({
        tagClass: function(item) {
          return 'label label-default';
        }
    });

     $('#nicknames_add').on('click, blur', function(){
        elt.tagsinput('add', $('.bootstrap-tagsinput input').val());
    });
  });
});
</script>
@endpush
