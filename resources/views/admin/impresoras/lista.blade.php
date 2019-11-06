@extends('layouts.app')
@section('titulo')
  Impresoras
@endsection
@section('contenedor')
  {{-- Barra de navegación --}}
  @include('admin.navegacion')

  <div class="container mb-3">
    <h1 class="display-5 mt-3">Listado de impresoras asignadas</h1>
    @include('admin.impresoras.acciones')
    <div class="table-responsive">
      <table class="table" id="impresoras">
        <thead>
          <th>ID</th>
          <th>Modelo</th>
          <th>Ubicación</th>
          <th>Cartuchos</th>
          <th></th>
        </thead>
        <tbody>
          @forelse ($impresoras as $impresora)
            <tr>
              <td>{{$impresora->impresora->id_impresora}}</td>
              <td>{{$impresora->impresora->modelo}}</td>
              <td>{{$impresora->ubicacion->planta}} - {{$impresora->ubicacion->departamento}}</td>
              <td>
                @isset($impresora->impresoraCartucho)
                  @forelse ($impresora->impresoraCartucho as $cartucho)
                    <span data-toggle="modal" data-id="{{$cartucho->cartucho->id_cartucho}}" data-relacion="{{$impresora->id}}" data-modelo="{{$cartucho->cartucho->modelo}}" class="badge-pointer activarModalTonerLista badge
                    @isset($cartucho->cartucho->cantidadSugerida)
                      @if (($cartucho->cartucho->cantidad >= $cartucho->cartucho->cantidadSugerida) && ($cartucho->cartucho->cantidad>0))
                        badge-success
                      @elseif ($cartucho->cartucho->cantidad >=1)
                        badge-warning
                      @else
                          badge-danger
                      @endif
                    @else
                      badge-info
                    @endisset
                      ">
                      {{$cartucho->cartucho->modelo}}
                    </span>
                  @empty
                    <span class="badge badge-secondary">Sin asignar</span>
                  @endforelse
                @endisset

              </td>
              <td><a href="{{route('impresora.show',$impresora->id_impresora)}}" class="btn btn-info btn-md">Administrar</a></td>
            </tr>
          @empty
            <tr><td><div class="alert alert-info">No hay relaciones de impresoras - ubicaciones</div></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
  @include('admin.impresoras.adminTonerLista')

  <script>
    $(document).ready(function(){
      $('.activarModalTonerLista').on('click',function(){
        $('#tituloTonerL').empty();
        $('#adminCantidadTonerL').val("")
        $('#adminCantidadSugeridaTonerL').val("")
        $('#adminUbicacionL').val("")

        $('#modalAdministrarTonerLista').modal({backdrop: 'static'})
        
        var id = $(this).data('id');
        var modelo = $(this).data('modelo');
        // var cantidad = $(this).data('cantidad');
        // var sugerido = $(this).data('sugerido');
        var relacion = $(this).data('relacion')
        // var ubicacion= $(this).data('ubicacion');

        // $.ajax({
        //   url:"{{route('infoCartucho')}}",
        //   type:"GET",
        //   data:{"_token":"{{csrf_token()}}",
        //         "cartucho":id},
        //   success:function(res){
        //     console.log(res)
        //   },
        //   error:function(err){
        //     console.error(err)
        //   }
        // })

        $('#tituloTonerL').html('Administrar toner '+modelo);
        $('#adminRelacionL').val(relacion);
        $('#adminIdCartuchoL').val(id);
        $('#listaUbicaciones').val(0).change();
        // $('#adminCantidadTonerL').val(cantidad)
        // $('#adminCantidadSugeridaTonerL').val(sugerido)
        // $('#adminUbicacionL').val(ubicacion)
      });
    })
  </script>




  {{-- Fin modals --}}
  <script>
    $(document).ready(function(){
      $("#impresoras").DataTable({
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
