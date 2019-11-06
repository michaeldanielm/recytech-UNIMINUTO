@extends('layouts.app')
@section('titulo')
  Impresora {{$impresora[0]->modelo}}
@endsection
@section('contenedor')
  {{-- Barra de navegación --}}
  @include('admin.navegacion')
  <div class="container mb-3">
    <h3 class="display-5">Información de la impresora {{$impresora[0]->modelo}} <button data-toggle="modal" data-target="#modalEditarImpresora" class="btn btn-warning"><i class="fa fa-edit"></i></button></h3>
    <div class="list-group" id="myList" role="tablist">
      <a class="list-group-item list-group-item-action active" data-toggle="list" href="#ubicacionesImp" role="tab">Ubicaciones</a>
      <a class="list-group-item list-group-item-action" data-toggle="list" href="#cartuchosImp" role="tab">Cartuchos</a>
    </div>

    <!-- Panel ubicaciones -->
    <div class="tab-content mt-3">
      <div class="tab-pane active" id="ubicacionesImp" role="tabpanel">
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalAsignarImpresora">Asignar a nueva ubicación <i class="fa fa-plus"></i></button>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>Planta</th>
              <th>Departamento</th>
              <th></th>
            </thead>
            <tbody>
              @forelse ($impresora[0]->impresoraUbicacion as $lugar)
                <tr>
                  <td>{{$lugar->ubicacion->planta}}</td>
                  <td>{{$lugar->ubicacion->departamento}}</td>
                  <td><button class="btn btn-danger" onclick="eliminarRelacionUbicacion({{$lugar->id}})">Eliminar <i class="fa fa-trash"></i></button></td>
                </tr>
              @empty
                <tr><td colspan="3"><div class="alert alert-info">Sin asignar</div></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>

      <div class="tab-pane" id="cartuchosImp" role="tabpanel">
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalAsignarToner">Asignar nuevo cartucho <i class="fa fa-plus"></i></button>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>ID cartucho</th>
              <th>Modelo</th>
              <th>Cantidad</th>
              <th>Sugeridos</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
              @forelse ($impresora[0]->impresoraCartucho as $cartucho)
                <tr>
                  <td>{{$cartucho->cartucho->id_cartucho}}</td>
                  <td>{{$cartucho->cartucho->modelo}}</td>
                  <td>{{$cartucho->cartucho->cantidad}}</td>
                  <td>{{$cartucho->cartucho->cantidadSugerida}}</td>
                  <td><button class="btn btn-warning btn-sm activarModalToner"  data-toggle="modal" data-id="{{$cartucho->cartucho->id_cartucho}}"  data-modelo="{{$cartucho->cartucho->modelo}}" data-cantidad="{{$cartucho->cartucho->cantidad}}" data-sugerido="{{$cartucho->cartucho->cantidadSugerida}}" ><i class="fa fa-plus"></i>/<i class="fa fa-minus"></i></button></td>
                  <td><button class="btn btn-danger" onclick="eliminarRelacionToner({{$cartucho->id}})">Eliminar <i class="fa fa-trash"></i></button></td>
                </tr>
              @empty
                <tr><td colspan="3"><div class="alert alert-info">Sin asignar</div></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @include('admin.impresoras.asignarImpresora')
  @include('admin.impresoras.asignarToner')
  @include('admin.impresoras.editarImpresora')
  @include('admin.impresoras.adminToner')

  <script>
    $('.activarModalToner').on('click',function(){

      $('#tituloToner').empty();
      $('#modalAdministrarToner').modal({backdrop: 'static'})
      var id = $(this).data('id');
      var modelo = $(this).data('modelo');
      var cantidad = $(this).data('cantidad');
      var sugerido = $(this).data('sugerido');
      $('#tituloToner').html('Administrar toner '+modelo);
      $('#adminIdCartucho').val(id);
      $('#adminCantidadToner').val(cantidad)
      $('#adminCantidadSugeridaToner').val(sugerido)
    });
  </script>
<script>
//Eliminar la impresora de la ubicación (por id)
  function eliminarRelacionUbicacion(id){
    swal({
          title: "Se eliminará la impresora de esta ubicación",
          buttons:["Cancelar","OK"],
          icon:'warning'
      })
      .then((value) => {
        if(value){
          $.ajax({
            url:"/impresoras/"+id,
            type:"DELETE",
            dataType:"JSON",
            data:{"id":id},
            success:function(resp){
              $.each(resp, function(llave,valor){
                if(valor==1){
                  swal({
                        title: "Correcto",
                        text: "Se eliminó la impresora de esta ubicación",
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
                  console.warn(resp)
                  console.warn(llave)
                  console.warn(valor)
                }
              })
            },
            error:function(err){
              console.warn(err)
            }
          })
        }else{
          console.log("No se eliminó")
        }
      });
  }

//Eliminar el cartucho de la impresora (por id)
    function eliminarRelacionToner(id){
      swal({
            title: "Se eliminará el toner de esta impresora",
            buttons:["Cancelar","OK"],
            icon:'warning'
        })
        .then((value) => {
          if(value){
            $.ajax({
              url:"/impresoraCartucho/"+id,
              type:"DELETE",
              dataType:"JSON",
              data:{"id":id},
              success:function(resp){
                $.each(resp, function(llave,valor){
                  if(valor==1){
                    swal({
                          title: "Correcto",
                          text: "Se eliminó el cartucho de esta impresora",
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
                console.warn(err)
              }
            })
          }else{
            console.log("No se eliminó")
          }
        });
    }
</script>
@endsection
