<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo registro de carpeta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" id="nuevo">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Nombre de la carpeta:</label>
                        <input type="text" class="form-control" name="nombre_carpeta" placeholder="Ejemplo: Sistemas" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Ruta:</label>
                        <input type="text" class="form-control" name="ruta" placeholder="192.168.1.76/Sistemas">
                    </div>
                </div>
             
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Usuario:</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Asdfg">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Contraseña:</label>
                        <input type="text" class="form-control" name="contrasena" placeholder="Asdfg">
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Planta:</label>
                        <input type="text" class="form-control" name="planta" placeholder="TDI1, TDI2, TH, ...">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Departamento:</label>
                        <input type="text" class="form-control" name="departamento" placeholder="Sistemas">
                    </div>
                </div>
            
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="">Acceso:</label>
                        <select name="acceso" id="" class="form-control">
                            <option value="Privado">Privado</option>
                            <option value="Público">Público</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Permisos:</label>
                        <select name="permisos" id="" class="form-control">
                            <option value="Lectura/Escritura">Lectura/Escritura</option>
                            <option value="Lectura">Solo lectura</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Papelera de reciclaje activa:</label>
                        <select name="papelera" id="" class="form-control">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="">Solicitantes</label>
                    <textarea name="solicitantes" class="form-control" placeholder="Nombre de las personas a quienes se asignó la carpeta"></textarea>
                </div>
                <button class="btn btn-success btn-block">Guardar <i class="fa fa-save"></i></button>
            </form>
        </div>
 
      </div>
    </div>
  </div>

  <script>
      $("#nuevo").submit(function(){
          event.preventDefault();
          $.ajax({
              url:"{{route('carpeta.store')}}",
              type:"POST",
              data:$("#nuevo").serialize(),
              success:function(res){
                  if(res.ok){
                    Swal.fire(
                    "Correcto",
                    "Se creó el registro",
                    "success"
                    )
                    setTimeout(function(){
                        location.reload()
                    },400)
                  }else{
                    Swal.fire(
                        "Error",
                        "Ocurrió un error al agregar",
                        "warning"
                    )
                    console.warn(res.error)
                  }
               
              },
              error:function(err){
                Swal.fire(
                    "Error",
                    "Ocurrió un error al agregar",
                    "warning"
                )
                console.warn(err)
              }
          })
      })
  </script>