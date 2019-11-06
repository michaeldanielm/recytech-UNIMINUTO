<div class="modal fade" id="modalAgregarToner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catálogo de toner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <form method="post" id="agregarToner">
              @csrf
              <div class="row">
                <div class="form-inline col-sm-6">
                  <label for="">Modelo*</label>
                  <input type="text" class="ml-3 form-control mr-3" name="modelo" placeholder="Nombre del cartucho" required>
                </div>
                <div class="form-inline col-sm-6">
                  <label for="">Cantidad*</label>
                  <input type="number" min="0" class="ml-3 form-control" name="cantidad" value="1" required>
                </div>

              </div>
              <div class="row">
                <div class="form-inline mt-1 col-sm-6">
                  <label for="">Sugeridos</label>
                  <input type="number" name="cantidadSugerida" min="0" class="form-control ml-1" value="0" placeholder="Cantidad sugerida">
                </div>
                <div id="selectUbDiv" class="col-sm-4 form-inline">
                  <label for="">Ubicación</label>
                  <select name="id_ubicacion" id="selectUb" class="ml-5" style="width:70%">
                    @forelse ($ubicaciones as $ubicacion)
                      <option value="{{$ubicacion->id_ubicacion}}">{{$ubicacion->planta}} {{$ubicacion->departamento}}</option>
                    @empty
                        <option disabled="disabled">No hay ubicaciones</option>
                    @endforelse
                  </select>
                </div>
              </div>

              <button class="btn btn-success m-2 btn-block">Agregar <i class="fa fa-plus-circle"></i></button>

            </form>
          </div>

          <hr>
          <a href="{{route('reporteToner')}}" class="btn btn-dark mb-3">Reporte de toner</a>
          <div class="table-responsive">
            <table class="table table-striped" id="catalogoToner">
              <thead>
                <th>ID</th>
                <th>Modelo</th>
                <th>Cantidad</th>
                <th>Sugeridos</th>
                <th>Ubicación</th>
                <th></th>
              </thead>
              <tbody>
                @isset($listadoToner)
                  @forelse ($listadoToner as $toner)
                    <tr>
                      <td>{{$toner->id_cartucho}}</td>
                      <td>{{$toner->cartucho->modelo}}</td>
                      <td>{{$toner->cantidad}}</td>
                      <td>{{$toner->cantidadSugerida}}</td>
                      <td>{{$toner->ubicacion->planta}} {{$toner->ubicacion->departamento}}</td>
                      <td><button data-toggle="modal" data-id="{{$toner->id_cartucho}}" data-ubicacion="{{$toner->id}}" data-modelo="{{$toner->cartucho->modelo}}" data-cantidad="{{$toner->cantidad}}" data-sugerido="{{$toner->cantidadSugerida}}" class="btn btn-warning activarModalToner"><i class="fa fa-plus-circle"></i>/<i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                  @empty
                    <tr><td colspan="3"><div class="alert alert-info">No hay cartuchos registrados</div></td></tr>
                  @endforelse
                @endisset
              </tbody>
            </table>
          </div>


      </div>

    </div>
  </div>
</div>

@include('admin.impresoras.adminToner')

<script>
  $(document).ready(function(){
    $('.activarModalToner').on('click',function(){
      $('#tituloToner').empty();
      $('#modalAdministrarToner').modal({backdrop: 'static'})
      var id = $(this).data('id');
      var modelo = $(this).data('modelo');
      var cantidad = $(this).data('cantidad');
      var sugerido = $(this).data('sugerido');
      var relacion = $(this).data('relacion')
      var ubicacion= $(this).data('ubicacion');
      $('#tituloToner').html('Administrar toner '+modelo);
      $('#adminRelacion').val(relacion);
      $('#adminIdCartucho').val(id);
      $('#adminCantidadToner').val(cantidad)
      $('#adminCantidadSugeridaToner').val(sugerido)
      $('#adminUbicacion').val(ubicacion)
    });
  })
</script>
<script>
  $("#agregarToner").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"POST",
      url: "{{route('cartucho.store')}}",
      data:$("#agregarToner").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se agregó el cartucho",
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
  function adminToner(id,cantidadActual){
    swal({
          title: 'Administrar toner '+id,
          text: 'Modificar cantidad',
          content: {
            element: 'input',
            value:cantidadActual
          }
        })
  }
</script>
<script>
$(document).ready(function(){
  $("#catalogoToner").DataTable({
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
<script>
$(document).ready(function() {
    $('#selectUb').select2({
      dropdownParent: $("#selectUbDiv"),
      language: {
            noResults: function () {
                 return "Sin resultados";
            }
        }
    });
});
</script>
