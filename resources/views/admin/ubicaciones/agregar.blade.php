<div class="modal fade" id="modalAgregarUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nueva ubicación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="adminAgregarUbicacion">
            @csrf
              <div class="form-group">
                <label for="">Planta</label>
                <input type="text" class="form-control" name="planta" required>
              </div>
              <div class="form-group">
                <label for="">Departamento</label>
                <input type="text" class="form-control" name="departamento" required>
              </div>
              <button class="btn btn-success">Agregar <i class="fa fa-arrow-right"></i></button>
            </form>
          </div>

          <hr>


      </div>

    </div>
  </div>


<script>
  $("#adminAgregarUbicacion").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"POST",
      url: "{{route('ubicaciones.store')}}",
      data:$("#adminAgregarUbicacion").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se agregó la ubicación",
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
