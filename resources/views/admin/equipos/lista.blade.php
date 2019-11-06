@extends('layouts.app')
@section('titulo')
  Lista de equipos
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container">
    <h1 class="display-5 mt-3">Listado de equipos</h1>
    <a href="{{route('reporteEquipos')}}" class="btn btn-dark">Reporte de equipos</a>
    @include('admin.equipos.acciones')
    <div class="table-responsive">
      <table class="table table-hover table-striped" id="equipos">
        <thead>
          <th>ID</th>
          <th>Nombre</th>
          <th>Lugar</th>
          <th>Tipo</th>
          <th></th>
        </thead>
        <tbody>
          @forelse ($equipos as $equipo)
            <tr>
              <td>{{$equipo->id_equipo}}</td>
              @isset($equipo->equipoPersona->persona)
                <td>{{$equipo->equipoPersona->persona->nombre}}</td>
                <td>{{$equipo->equipoPersona->persona->ubicacion->planta}} - {{$equipo->equipoPersona->persona->ubicacion->departamento}}</td>
              @else
                <td><span class="badge badge-secondary">Sin asignar</span></td>
                <td><span class="badge badge-secondary">Sin asignar</span></td>
              @endisset
              <td>{{$equipo->tipo}}</td>
              <td><a href="{{route('equipos.show',$equipo->id_equipo)}}" class="btn btn-info">Administrar</a></td>
            </tr>
          @empty
            <tr>
              <td><div class="alert alert-info">No hay equipos</div></td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

  <script>
    $(document).ready(function(){
      $("#equipos").DataTable({
        responsive:true,
        "language": {
          "emptyTable":     "Sin datos",
          "info":           "Mostrando del _START_ al _END_ de _TOTAL_ ",
          "infoEmpty":      "Mostrando 0 de 0 de los 0 resultados",
          "infoFiltered":   "(Filtrado de _MAX_ resultados)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "Mostrar hasta _MENU_ resultados por página",
          "loadingRecords": "Cargando...",
          "processing":     "Procesando...",
          "search":         "<i class='fa fa-search'></i> Buscar:",
          "zeroRecords":    "No hay resultados para la búsqueda",
          "paginate": {
              "first":      "Primero",
              "last":       "Último",
              "next":       "Siguiente",
              "previous":   "Anterior"
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
