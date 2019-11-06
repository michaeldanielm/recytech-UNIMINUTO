@extends('layouts.app')
@section('titulo')
  Todas las carpetas
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container-fluid">
    <h1 class="display-5 mt-3 text-center fa-spin">Listado de carpetas en red</h1>
    <button class="btn btn-success fa-spin" data-toggle="modal" data-target="#modalCrear">Agregar <i class="fa fa-plus"></i></button>
    <div class="table-responsive">
      <table class="table table-hover table-striped" id="carpetas">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ruta</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Ubicación</th>
                <th>Acceso</th>
                <th>Permisos</th>
                <th>Papelera de reciclaje</th>
                <th>Solicitantes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carpetas as $c)
                <tr>
                    <td>{{$c->nombre_carpeta}}</td>
                    <td>{{$c->ruta}}</td>
                    <td>{{$c->usuario}}</td>
                    <td>{{$c->contrasena}}</td>
                    <td>{{$c->planta}} - {{$c->departamento}}</td>
                    <td>{{$c->acceso}}</td>
                    <td>{{$c->permisos}}</td>
                    <td>{{$c->papelera==1 ? 'Sí' : 'No'}}</td>
                    <td>{{$c->solicitantes}}</td>
                    <td><a href="{{route('carpeta.show',$c)}}" class="btn btn-info"><i class="fa fa-cog fa-spin"></i></a></td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
      </table>
    </div>

  </div>
  @include('admin.carpetas.crear')

  <script>
    $(document).ready(function(){
      $("#carpetas").DataTable({
        responsive:true,
        "language": {
          "emptyTable":     "Sin datos",
          "info":           "<p class='fa-spin'>Mostrando del _START_ al _END_ de _TOTAL_ </p>",
          "infoEmpty":      "Mostrando 0 de 0 de los 0 resultados",
          "infoFiltered":   "(Filtrado de _MAX_ resultados)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "Mostrar hasta _MENU_ resultados por página",
          "loadingRecords": "Cargando...",
          "processing":     "Procesando...",
          "search":         "<i class='fa fa-search fa-spin'></i> Buscar:",
          "zeroRecords":    "No hay resultados para la búsqueda",
          "paginate": {
              "first":      "Primero",
              "last":       "Último",
              "next":       "<p class='fa-spin'>Siguiente</p>",
              "previous":   "<p class='fa-spin'>Anterior</p>"
          },
          "aria": {
              "sortAscending":  ": Orden ascendente",
              "sortDescending": ": Orden descendente"
          }
        }

      });
    })
  </script>
@endsection
