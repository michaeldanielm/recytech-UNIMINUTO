<div class="modal fade" id="modalAsignarToner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar toner a impresora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="asignarToner">
            @csrf
              <div class="form-group">

                <label for="">Impresora</label>
                @isset($impresora[0]->id_impresora)
                  <input list="modelosImpresoras" class="form-control" name="id_impresora" autocomplete="off" required id="id_impresoraT" value="{{$impresora[0]->modelo}}" readonly>
                @else
                  <input list="modelosImpresoras" class="form-control" name="id_impresora" autocomplete="off" required id="id_impresoraT">
                @endisset

                <datalist id="modelosImpresorasT">
                  @forelse ($listadoImpresoras as $impresora)
                    <option data-value="{{$impresora->id_impresora}}" value="{{$impresora->modelo}}">
                  @empty
                    <option value="0" disabled>No hay impresoras</option>
                  @endforelse
                </datalist>

              </div>


              <div class="form-group">
                <label for="">Cartucho</label>
                <input name="id_cartucho" list="cartuchos" class="form-control" autocomplete="off" required id="id_cartuchoT">
                <datalist id="cartuchos">
                  @foreach ($listadoToner as $toner)
                    <option data-value="{{$toner->id_cartucho}}" value="{{$toner->modelo}}">
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
@include('admin.ubicaciones.agregar')

<script>
  $("#asignarToner").submit(function(){
    event.preventDefault();

    //Mostrar el valor del datalist en el input
    var impresoraMostrada = document.getElementById("id_impresoraT").value;
    @isset($impresora[0]->id_impresora)
      var impresoraId = {{$impresora[0]->id_impresora}}
    @else
    var impresoraId = document.querySelector("#modelosImpresoras option[value='"+impresoraMostrada+"']").dataset.value;
    @endisset
    var cartuchoMostrado = document.getElementById("id_cartuchoT").value;
    var cartuchoId = document.querySelector("#cartuchos option[value='"+cartuchoMostrado+"']").dataset.value;

    $.ajax({
      type:"POST",
      url: "{{route('impresoraCartucho.store')}}",
      data:{
        "id_impresora":impresoraId,
        "id_cartucho":cartuchoId
      },
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se asignó el toner",
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
