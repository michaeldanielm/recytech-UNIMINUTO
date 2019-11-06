<div class="modal fade" id="modalAgregarPersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catálogo de personas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <form method="post" id="agregarPersona">
              @csrf

              <div class="form-group">
                <label for="">Código de empleado</label>
                <input type="number" min="0" name="codigo_empleado" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nombre" class="form-control">
              </div>



              <div class="form-group">
                <label for="">Ubicación*</label>
                <input type="text" class="form-control" required list="listaUbicaciones" id="id_ubicacion">
                <a href="#!" data-dismiss="modal" data-toggle="modal" data-target="#modalAgregarUbicacion">Agregar ubicación</a>
                <datalist id="listaUbicaciones">
                  @foreach ($ubicaciones as $ubicacion)
                    <option data-value="{{$ubicacion->id_ubicacion}}" value="{{$ubicacion->planta}} {{$ubicacion->departamento}}"></option>
                  @endforeach
                </datalist>
              </div>

              <div class="form-group">
                <label for="">Puesto</label>
                <input type="text" name="puesto" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Jefe</label>
                <input type="text" name="jefe" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Correo</label>
                <input type="text" name="correo" class="form-control">
              </div>

              <button class="btn btn-success btn-block mb-3">Guardar <i class="fa fa-save"></i></button>
            </form>
          </div>
          <div class="table-responsive">
            <table id="catalogoPersonas" class="table table-hover table-striped mt-2">
              <thead>
                <th>Código de empleado</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Puesto</th>
                <th>Jefe</th>
                <th>Correo</th>
                <th></th>
                {{-- <th></th> --}}
              </thead>
              <tbody>
                @forelse ($personas as $persona)
                  <tr>
                    <td>{{$persona->codigo_empleado}}</td>
                    <td>{{$persona->nombre}}</td>
                    <td>{{$persona->ubicacion->planta}} {{$persona->ubicacion->departamento}}</td>
                    <td>{{$persona->puesto}}</td>
                    <td>{{$persona->jefe}}</td>
                    <td>{{$persona->correo}}</td>
                    <td><a class="btn btn-warning" href="{{route('persona.edit',$persona->id_persona)}}"><i class="fa fa-edit"></i></a></td>
                    {{-- <td><button class="btn btn-warning"><i class="fa fa-edit"></i></button></td> --}}
                  </tr>
                @empty

                @endforelse
              </tbody>
            </table>
          </div>

      </div>
    </div>
  </div>
</div>

<script>
  $("#agregarPersona").submit(function(){
    event.preventDefault();

    //Mostrar el valor del datalist en el input
    var ubicacionMostrada = document.getElementById("id_ubicacion").value;
    var ubicacionId = document.querySelector("#listaUbicaciones option[value='"+ubicacionMostrada+"']").dataset.value;

    $.ajax({
      type:"POST",
      url: "{{route('persona.store')}}",
      data: $("#agregarPersona").serialize()+"&id_ubicacion="+ubicacionId,
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se agregó a la persona",
                  icon: "success",
                  button: "OK",
                });
            setTimeout(function(){
              location.reload()
            },2000)
          }else{
            swal({
              title: "Error",
              text: "Ocurrió un error:, "+valor,
              icon: "error",
              button: "OK",
            });
          console.warn(valor)
          }
        })
      },
      error:function(err){
        console.error(err)
      }
    })
  })
</script>
<script>
$(document).ready(function(){
  $("#catalogoPersonas").DataTable({
    "iDisplayLength": 5,
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
  })
})
</script>
