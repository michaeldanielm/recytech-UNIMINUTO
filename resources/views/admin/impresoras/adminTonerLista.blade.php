<div class="modal fade" id="modalAdministrarTonerLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h5 class="modal-title" id="tituloTonerL">Administrar toner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adminTonerCantidadL">
          <div>
            <form method="post" id="adminTonerLista">
              @csrf

              <div class="form-group">
                <label for="">Ubicación del toner a descontar</label>
                <select name="id_rel" id="listaUbicaciones" class="s2li" style="width:75%">
                  <option disabled value="0" selected>Selecciona una opción</option>
                  @foreach ($ubicaciones as $ub)
                    <option value="{{$ub->id_ubicacion}}">{{$ub->planta}} {{$ub->departamento}}</option>
                  @endforeach
                </select>
              </div>

              <input type="hidden" id="adminInventarioL" name="id_inventario" value="">
              <input type="hidden" name="id_cartucho" id="adminIdCartuchoL" value="">
              <input type="hidden" id="adminRelacionL" name="id_relacion">
              <input type="hidden" name="id_ubicacion" value="" id="adminUbicacionL">

              <div class="form-group">
                <label for="">Cantidad</label>
                <input type="number" id="adminCantidadTonerL" min="0" class="ml-3 form-control" name="cantidad" required>
              </div>
              <hr>
              <div class="form-group">
                <label for="">Cantidad sugerida <i class="fa fa-info-circle"></i></label>
                <input type="number" id="adminCantidadSugeridaTonerL" min="0" class="ml-3 form-control" name="cantidadSugerida">
              </div>
              <button class="btn btn-secondary btn-block">Actualizar <i class="fa fa-save"></i></button>
            </form>
          </div>
          <hr>
      </div>
    </div>
  </div>
</div>

<script>
$("#listaUbicaciones").on('change', function(e) {
    $('#adminCantidadTonerL').val("")
    $('#adminCantidadSugeridaTonerL').val("")
    $('#adminUbicacionL').val("")

    data=$(this).select2('data');
    $.ajax({
      url:"{{route('infoRelacion')}}",
      type:"GET",
      data:{
            "_token":"{{csrf_token()}}",
            "id_cartucho":$("#adminIdCartuchoL").val(),
            "id_ubicacion":data[0].id
            },
      success:function(res){
        console.log(res)
        $('#adminInventarioL').val(res.id)
        $('#adminCantidadTonerL').val(res.cantidad)
        $('#adminCantidadSugeridaTonerL').val(res.cantidadSugerida)
        $('#adminUbicacionL').val(res.id_ubicacion)
      },
      error:function(err){
        console.error(err)
      }

    })
});
</script>

<script>
  $("#adminTonerLista").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"PUT",
      url: "{{route('cartucho.update',0)}}",
      data:$("#adminTonerLista").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se actualizó la cantidad",
                  icon: "success",
                  button: "OK",
                });
            // setTimeout(function(){
            //   location.reload()
            // },2000)
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
    $(document).ready(function() {
      $('.s2li').select2({
        dropdownParent: $("#modalAdministrarTonerLista"),
        language: {
                noResults: function () {
                     return "Sin resultados";
                }
            }
      });
    });
  </script>
