@extends('layouts.app')
@section('titulo')
  Editar persona
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container mt-3 mb-5">
    <button onclick="eliminarPersona({{$persona->id_persona}})" class="btn btn-danger">Eliminar persona <i class="fa fa-trash"></i></button>
    <p><small><em>*No puedes eliminar a la persona si tiene un equipo asignado</em></small></p>
    <form method="post" id="editarPersona">
      @csrf
      <div class="row">
        <div class="form-group col">
          <label for="">Código de empleado</label>
          <input type="text" class="form-control" name="codigo_empleado" value="{{$persona->codigo_empleado}}">
        </div>
        <div class="form-group col">
          <label for="">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{$persona->nombre}}">
        </div>
        <div class="form-group col">
          <label for="">Puesto</label>
          <input type="text" class="form-control" name="puesto" value="{{$persona->puesto}}">
        </div>
      </div>

      <div class="row">
        <div class="form-group col">
          <label for="">Correo</label>
          <input type="text" class="form-control" name="correo" value="{{$persona->correo}}">
        </div>
        <div class="form-group col">
          <label for="">Jefe directo</label>
          <input type="text" class="form-control" name="jefe" value="{{$persona->jefe}}">
        </div>
        <div class="form-group col">
          <label for="">Ubicación</label>
          <input type="text" class="form-control" list='listaUbicaciones' id="id_ubicacion" autocomplete="0" value="{{$persona->ubicacion->planta}} {{$persona->ubicacion->departamento}}">
          <a href="#!" data-toggle="modal" data-target="#modalAgregarUbicacion">Agregar ubicación</a>
          <datalist id="listaUbicaciones">
          @forelse ($ubicaciones as $ubicacion)
            <option @if ($persona->id_ubicacion==$ubicacion->id_ubicacion)
              selected
            @endif data-value="{{$ubicacion->id_ubicacion}}" value="{{$ubicacion->planta}} {{$ubicacion->departamento}}">
          @empty
            <option value="No hay ubicaciones" disabled>
          @endforelse
          </datalist>
        </div>
      </div>
      <button class="btn btn-primary btn-block">Guardar <i class="fa fa-save"></i></button>
    </form>
  </div>
  @include('admin.ubicaciones.agregar')
  <script>
  $("#editarPersona").submit(function(){
    event.preventDefault();
    var ubicacionMostrada = document.getElementById("id_ubicacion").value;
    var ubicacionId = document.querySelector("#listaUbicaciones option[value='"+ubicacionMostrada+"']").dataset.value;
    $.ajax({
      type:"PUT",
      url:"{{route('persona.update',$persona->id_persona)}}",
      data:$("#editarPersona").serialize()+"&id_ubicacion="+ubicacionId,
      success:function(resp){
        $.each(resp, function(llave,valor){
          if(valor==1){
            swal({
                  title: "Correcto",
                  text: "Se editó la persona",
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
  function eliminarPersona(id){
    swal({
          title: "Se eliminará a la persona",
          buttons:["Cancelar","OK"],
          icon:'warning'
      })
      .then((value) => {
        if(value){
          $.ajax({
            url:"{{ route('persona.destroy',0) }}",
            type:"DELETE",
            dataType:"JSON",
            data:{"id":id},
            success:function(resp){
              $.each(resp, function(llave,valor){
                if(valor==1){
                  swal({
                        title: "Correcto",
                        text: "Se eliminó a la persona",
                        icon: "success",
                        button: "OK",
                      });
                  setTimeout(function(){
                    location.href="{{route('equipos.index')}}"
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
