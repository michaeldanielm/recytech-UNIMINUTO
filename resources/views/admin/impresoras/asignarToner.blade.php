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
              <div class="form-group s2C">

                <label for="">Impresora</label>
                <select name="id_impresora" id="" class="s2" style="width:75%">
                  @forelse ($listadoImpresoras as $impresora)
                    <option value="{{$impresora->id_impresora}}">{{$impresora->modelo}}</option>
                  @empty
                    <option value="0" disabled>No hay impresoras</option>
                  @endforelse
                </select>

              </div>


              <div class="form-group s2C">
                <label for="">Cartucho</label>
                <select name="id_cartucho" id="" class="s2" style="width:75%">
                  @forelse ($cartuchos as $toner)
                      <option value="{{$toner->id_cartucho}}">{{$toner->modelo}}</option>
                  @empty
                      <option disabled>No hay cartuchos</option>
                  @endforelse
                </select>

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
    // var impresoraMostrada = document.getElementById("id_impresoraT").value;
    // @isset($impresora[0]->id_impresora)
    //   var impresoraId = {{$impresora[0]->id_impresora}}
    // @else
    // var impresoraId = document.querySelector("#modelosImpresoras option[value='"+impresoraMostrada+"']").dataset.value;
    // @endisset
    // var cartuchoMostrado = document.getElementById("id_cartuchoT").value;
    // var cartuchoId = document.querySelector("#cartuchos option[value='"+cartuchoMostrado+"']").dataset.value;

    $.ajax({
      type:"POST",
      url: "{{route('impresoraCartucho.store')}}",
      data:$("#asignarToner").serialize(),
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
<script>
$(document).ready(function() {
  $('.s2').select2({
    dropdownParent: $("#modalAsignarToner"),
    language: {
            noResults: function () {
                 return "Sin resultados";
            }
        }
  });
});
</script>
