<div class="modal fade" id="modalAgregarImpresora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catálogo de impresoras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div>
            <form method="post" id="agregarImpresora">
              @csrf
              <div class="form-inline">
                <label for="">Modelo *</label>
                <input type="text" class="ml-3 form-control" name="modelo" required>
                <button class="btn btn-success ml-2">Agregar <i class="fa fa-plus-circle"></i></button>
              </div>
            </form>
          </div>

          <hr>
          <div class="table-responsive">
            <table class="table table-striped" id="catalogoImpresoras">
              <thead>
                <th>ID</th>
                <th>Modelo</th>
                <th></th>
              </thead>
              <tbody>
                @isset($listadoImpresoras)
                  @forelse ($listadoImpresoras as $impresora)
                    <tr>
                      <td>{{$impresora->id_impresora}}</td>
                      <td>{{$impresora->modelo}}</td>
                      <td><a href="{{route('impresora.show',$impresora->id_impresora)}}" class="btn btn-info btn-md">Administrar</a></td>
                    </tr>
                  @empty
                    <tr><td colspan="3"><div class="alert alert info">No hay impresoras</div></td></tr>
                  @endforelse
                @endisset
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>


<script>
  $("#agregarImpresora").submit(function(){
    event.preventDefault();
    $.ajax({
      type:"POST",
      url: "{{route('impresora.store')}}",
      data:$("#agregarImpresora").serialize(),
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se agregó la impresora",
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
$(document).ready(function(){
  $("#catalogoImpresoras").DataTable({
    "iDisplayLength": 5,
    "language": {
      "emptyTable":     "Sin datos",
      "info":           "Mostrando del _START_ al _END_ de _TOTAL_ ",
      "infoEmpty":      "Mostrando 0 de 0 de los 0 resultados",
      "infoFiltered":   "(Filtrado de _MAX_ resultados)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     "Mostrar hasta _MENU_ resultados por página",
      "loadingRecords": "Cargando...",
      "processing":     "Procesando...",
      "search":         "<i class='fa fa-search'></i> Buscar:",
      "zeroRecords":    "No hay resultados para la búsqueda",
      "paginate": {
          "first":      "Primero",
          "last":       "Último",
          "next":       "Siguiente",
          "previous":   "Anterior"
      },
      "aria": {
          "sortAscending":  ": Orden ascendente",
          "sortDescending": ": Orden descendente"
      }
    }
  })
})
</script>
