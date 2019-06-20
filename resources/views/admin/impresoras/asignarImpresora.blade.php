<div class="modal fade" id="modalAsignarImpresora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar impresora a ubicación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="asignarImpresora">
            @csrf
              <div class="form-group">

                <label for="">Modelo</label>

                @isset($impresora[0]->id_impresora)
                  <input list="modelosImpresoras" class="form-control" name="id_impresora" autocomplete="off" required id="id_impresora" value="{{$impresora[0]->modelo}}" readonly>
                @else
                  <input list="modelosImpresoras" class="form-control" name="id_impresora" autocomplete="off" required id="id_impresora">
                @endisset

                <datalist id="modelosImpresoras">
                  @forelse ($listadoImpresoras as $impresora)
                    <option data-value="{{$impresora->id_impresora}}" value="{{$impresora->modelo}}">
                  @empty
                    <option value="0" disabled>No hay impresoras</option>
                  @endforelse
                </datalist>

              </div>


              <div class="form-group">
                <label for="">Ubicación</label>
                <input name="id_ubicacion" list="ubicaciones" class="form-control" autocomplete="off" required id="id_ubicacion">
                <a href="#!" data-dismiss="modal" data-toggle="modal" data-target="#modalAgregarUbicacion">Agregar ubicación</a>
                <datalist id="ubicaciones">
                  @foreach ($ubicaciones as $ubicacion)
                    <option data-value="{{$ubicacion->id_ubicacion}}" value="{{$ubicacion->planta}} {{$ubicacion->departamento}}"></option>
                  @endforeach
                </datalist>
              </div>
              <button class="btn btn-success">Asignar <i class="fa fa-arrow-right"></i></button>
            </form>
          </div>

          <hr>

      </div>

    </div>
  </div>
{{-- @include('admin.ubicaciones.agregar') --}}

<script>
  $("#asignarImpresora").submit(function(){
    event.preventDefault();

    //Mostrar el valor del datalist en el input
    var impresoraMostrada = document.getElementById("id_impresora").value;
    @isset($impresora[0]->id_impresora)
      var impresoraId = {{$impresora[0]->id_impresora}}
    @else
      var impresoraId = document.querySelector("#modelosImpresoras option[value='"+impresoraMostrada+"']").dataset.value;
    @endisset

    var ubicacionMostrada = document.getElementById("id_ubicacion").value;
    var ubicacionId = document.querySelector("#ubicaciones option[value='"+ubicacionMostrada+"']").dataset.value;

    $.ajax({
      type:"POST",
      url: "{{route('impresoras.store')}}",
      data:{
        "id_impresora":impresoraId,
        "id_ubicacion":ubicacionId
      },
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se asignó la impresora",
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
