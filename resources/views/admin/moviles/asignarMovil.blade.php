<div class="modal fade" id="modalAsignarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <form method="post" id="asignarEquipo">
              @csrf
              <div class="form-group">
                <label for="">Persona*</label>
                <input type="text" class="form-control" required list="listaPersonas" id="id_persona">
                <datalist id="listaPersonas">
                  @foreach ($personas as $persona)
                    <option data-value="{{$persona->id_persona}}" value="{{$persona->nombre}} ({{$persona->ubicacion->planta}} {{$persona->ubicacion->departamento}})"></option>
                  @endforeach
                </datalist>
              </div>
              <button class="btn btn-success btn-block">Guardar <i class="fa fa-save"></i></button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>


<script>
  $("#asignarEquipo").submit(function(){
    event.preventDefault();

    //Mostrar el valor del datalist en el input
    var personaMostrada = document.getElementById("id_persona").value;
    var personaId = document.querySelector("#listaPersonas option[value='"+personaMostrada+"']").dataset.value;

    $.ajax({
      type:"POST",
      url: "{{route('equiposPersonas.store')}}",
      data: {'id_equipo':{{$equipo[0]->id_equipo}},'id_persona':personaId},
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se asigno a la persona",
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
