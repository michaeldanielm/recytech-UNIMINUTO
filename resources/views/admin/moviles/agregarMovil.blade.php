<div class="modal fade" id="modalAgregarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <form method="post" id="agregarEquipo">
              @csrf
              <div class="form-group">
                <label for="">Tipo*</label>
                <select name="tipo" id="" class="form-control" required>
                  <option value="Laptop">Laptop</option>
                  <option value="Escritorio">Escritorio</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Marca</label>
                <input type="text" class="form-control" name="marca">
              </div>
              <div class="form-group">
                <label for="">Modelo</label>
                <input type="text" class="form-control" name="modelo">
              </div>
              <div class="form-group">
                <label for="">Número de serie</label>
                <input type="text" class="form-control" name="ns">
              </div>
              <div class="form-group">
                <label for="">Procesador</label>
                <input type="text" class="form-control" name="procesador">
              </div>
              <div class="form-group">
                <label for="">RAM <small>GB</small></label>
                <input type="text" class="form-control" name="ram">
              </div>
              <div class="form-group">
                <label for="">Disco Duro</label>
                <input type="text" class="form-control" name="disco_duro">
              </div>
              <div class="form-group">
                <label for="">Sistema operativo</label>
                <input type="text" class="form-control" name="sistema_operativo">
              </div>
              <div class="form-group">
                <label for="">Descripción o datos adicionales</label>
                <textarea class="form-control" name="descripcion"></textarea>
                <small>Especificar versión y arquitectura; ej: Windows 10 Pro x64</small>
              </div>
              <div class="form-group">
                <label for="">MAC</label>
                <input type="text" class="form-control" name="mac">
                <small>Especificar con (Eth) o (Wifi), en caso de tener ambas, separar con ;</small>
                <small>(Eth)00:00:00:00:00;(Wifi)00:00:00:00:00</small>
              </div>
              <button class="btn btn-success btn-block">Guardar <i class="fa fa-save"></i></button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<script>
  $("#agregarEquipo").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"POST",
      url: "{{route('equipos.store')}}",
      data:$("#agregarEquipo").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se agregó el equipo",
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
