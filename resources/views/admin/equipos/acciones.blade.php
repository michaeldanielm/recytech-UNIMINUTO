<div class="card mb-3">
  <div class="row mt-2">
    <button class="btn btn-info col mr-1" data-toggle="modal" data-target="#modalAgregarEquipo">Agregar equipos <i class="fa fa-plus-circle"></i></button>
    <button class="btn btn-primary col"  data-toggle="modal" data-target="#modalAgregarPersona">Catálogo de personas <i class="fa fa-plus-circle"></i></button>
  </div>
  {{-- <div class="row m-1">
    <button class="btn btn-secondary col mr-1" data-toggle="modal" data-target="#modalAsignarEquipo">Asignar equipo a persona <i class="fa fa-arrows-alt-h"></i></button>
  </div> --}}
</div>
@include('admin.equipos.agregarEquipo')
@include('admin.equipos.catalogoPersonas')
{{-- @include('admin.equipos.asignarEquipo') --}}
@include('admin.ubicaciones.agregar')
