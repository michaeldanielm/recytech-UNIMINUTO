<div class="modal fade" id="modalAdministrarToner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary">
        <h5 class="modal-title" id="tituloToner">Administrar toner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="adminTonerCantidad">
          <div>
            <form method="post" id="adminToner">
              @csrf
              <input type="hidden" name="id_cartucho" id="adminIdCartucho" value="">
              <div class="form-group">
                <label for="">Cantidad</label>
                <input type="number" id="adminCantidadToner" min="0" class="ml-3 form-control" name="cantidad" required>
              </div>
              <hr>
              <div class="form-group">
                <label for="">Cantidad sugerida <i class="fa fa-info-circle"></i></label>
                <input type="number" id="adminCantidadSugeridaToner" min="0" class="ml-3 form-control" name="cantidadSugerida">
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
  $("#adminToner").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"PUT",
      url: "{{route('cartucho.update',0)}}",
      data:$("#adminToner").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se actualizó la cantidad",
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
