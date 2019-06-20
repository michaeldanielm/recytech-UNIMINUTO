<div class="card mb-3">
  <div class="row mt-2">
    <button class="btn btn-info col mr-1" data-toggle="modal" data-target="#modalAgregarImpresora">Catálogo de impresoras <i class="fa fa-plus-circle"></i></button>
    <button class="btn btn-primary col"  data-toggle="modal" data-target="#modalAgregarToner">Catálogo de toner <i class="fa fa-plus-circle"></i></button>
  </div>
  <div class="row m-1">
    <button class="btn btn-secondary col mr-1" data-toggle="modal" data-target="#modalAsignarImpresora">Asignar impresora a ubicación <i class="fa fa-arrows-alt-h"></i></button>
    <button class="btn btn-secondary col" data-toggle="modal" data-target="#modalAsignarToner">Asignar toner a impresora <i class="fa fa-arrows-alt-h"></i></button>
  </div>
</div>

{{-- Modals --}}
@include('admin.impresoras.agregarImpresora')
@include('admin.impresoras.agregarToner')
@include('admin.impresoras.asignarImpresora')
@include('admin.impresoras.asignarToner')
