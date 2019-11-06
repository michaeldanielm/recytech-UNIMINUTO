<div class="modal fade" id="modalEditarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar equipo {{$equipo[0]->id_equipo}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       </div>
        <div class="modal-body">
          <form method="post" id="editarEquipo">
            @csrf
            <div class="row">
              {{-- <div class="form-group col-4">
                <label for="">Tipo</label>

                <select name="tipo" id="" class="form-control" required>
                  <option {{$equipo[0]->tipo=='Laptop' ? 'selected' : ''}} value="Laptop">Laptop</option>
                  <option {{$equipo[0]->tipo=='Escritorio' ? 'selected' : ''}} value="Escritorio">Escritorio</option>
                </select>
              </div> --}}
              <div class="form-group col-4">
                <label for="">Marca</label>
                <input type="text" class="form-control" value="{{$equipo[0]->marca}}" name="marca">
              </div>
              <div class="form-group col-4">
                <label for="">Modelo</label>
                <input type="text" class="form-control" value="{{$equipo[0]->modelo}}" name="modelo">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-4">
                <label for="">Procesador</label>
                <input type="text" class="form-control" value="{{$equipo[0]->procesador}}" name="procesador">
              </div>
              <div class="form-group col-4">
                <label for="">RAM</label>
                <input type="text" class="form-control" value="{{$equipo[0]->ram}}" name="ram">
              </div>
              <div class="form-group col-4">
                <label for="">Disco duro</label>
                <input type="text" class="form-control" value="{{$equipo[0]->disco_duro}}" name="disco_duro">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label for="">Número de serie</label>
                <input type="text" class="form-control" value="{{$equipo[0]->ns}}"  name="ns">
              </div>
              <div class="form-group col-6">
                <label for="">Sistema operativo</label>
                <input type="text" class="form-control" value="{{$equipo[0]->sistema_operativo}}"  name="sistema_operativo">
              </div>
            </div>

            <div class="row">
              <div class="form-group col">
                <label for="">MAC Address</label>
                <input type="text" class="form-control" value="{{$equipo[0]->mac}}" name="mac">
              </div>
            </div>

            <div class="row">
              <div class="form-group col">
                <label for="">Descripción</label>
                <textarea type="text" class="form-control" name="descripcion">{{$equipo[0]->descripcion}}</textarea>
              </div>
            </div>
            <button class="btn btn-success btn-block">Guardar <i class="fa fa-save"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
  $("#editarEquipo").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"PUT",
      url: "{{route('equipos.update',$equipo[0]->id_equipo)}}",
      data:$("#editarEquipo").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se editó el equipo",
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
