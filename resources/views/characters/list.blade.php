@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          @if ($errors->has('success'))
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! $errors->first('success') !!}
          </div>
          @endif
          <p><a href="{{ route('new_character') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nuevo Personaje</a></p>
          <table class="table table-bordered" id="characters-table">
              <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>Apodo</th>
                      <th>Imagen</th>
                      <th width="10%">Acciones</th>
                  </tr>
              </thead>
          </table>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
$(function() {
  $(document).ready(function(){
    $('#characters-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax: '{!! route('list_characters') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'nickname', name: 'nickname' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
          { targets: 2,
            render: function(data) {
              return '<img class="data-picture" src="/uploads/images/'+data+'">'
            }
          }
        ]
    });
  });
});
</script>
@endpush
