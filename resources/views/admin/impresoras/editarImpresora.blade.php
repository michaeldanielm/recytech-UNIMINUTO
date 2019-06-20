<div class="modal fade" id="modalEditarImpresora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar impresora {{$impresora[0]->modelo}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="editarImpresora">
            @csrf
            <input type="hidden" name="id_impresora" value="{{$impresora[0]->id_impresora}}">
              <div class="form-group">
                <label for="">Nuevo nombre</label>
                <input class="form-control" name="modelo" autocomplete="off" required  value="{{$impresora[0]->modelo}}">
              </div>
              <button class="btn btn-success">Editar <i class="fa fa-edit"></i></button>
            </form>
          </div>
          <hr>
      </div>
    </div>
  </div>

<script>
  $("#editarImpresora").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"PUT",
      url: "{{route('impresora.update',$impresora[0]->id_impresora)}}",
      data:$("#editarImpresora").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se editó la impresora",
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
