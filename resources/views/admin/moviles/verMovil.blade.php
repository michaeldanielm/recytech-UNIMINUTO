@extends('layouts.app')
@section('titulo')
  Equipo
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container mb-5">
    <h1 class="display-5 mt-3">Equipo {{$equipo[0]->id_equipo}} <button data-toggle="modal" data-target="#modalEditarEquipo" class="btn btn-warning"><i class="fa fa-edit"></i></button></h1>
    @isset($equipo[0]->equipoPersona->persona)
      <p class="lead">Asignado a</p>
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <th>Código de empleado</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Puesto</th>
            <th>Jefe</th>
            <th>Correo</th>
            <th></th>
            <th></th>
          </thead>
          <tbody>
            <tr>
              <td>{{$equipo[0]->equipoPersona->persona->codigo_empleado}}</td>
              <td>{{$equipo[0]->equipoPersona->persona->nombre}}</td>
              <td>{{$equipo[0]->equipoPersona->persona->ubicacion->planta}} {{$equipo[0]->equipoPersona->persona->ubicacion->departamento}}</td>
              <td>{{$equipo[0]->equipoPersona->persona->puesto}}</td>
              <td>{{$equipo[0]->equipoPersona->persona->jefe}}</td>
              <td>{{$equipo[0]->equipoPersona->persona->correo}}</td>
              <td><a class="btn btn-warning" href="{{route('persona.edit',$equipo[0]->equipoPersona->persona->id_persona)}}"><i class="fa fa-edit"></i></a></td>
              <td><button onclick="eliminarRelacionEquipoPersona({{$equipo[0]->equipoPersona->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
            </tr>
          </tbody>
        </table>
      </div>

      @else
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAsignarEquipo">Asignar este equipo <i class="fa fa-plus-circle"></i></button>
        <button class="btn btn-danger" onclick="eliminarEquipo({{$equipo[0]->id_equipo}})">Eliminar equipo <i class="fa fa-trash"></i></button>
    @endisset
    <hr>
    <div class="row">
      <div class="form-group col-4">
        <label for="">Tipo</label>
        <input type="text" class="form-control" value="{{$equipo[0]->tipo}}" readonly>
      </div>
      <div class="form-group col-4">
        <label for="">Marca</label>
        <input type="text" class="form-control" value="{{$equipo[0]->marca}}" readonly>
      </div>
      <div class="form-group col-4">
        <label for="">Modelo</label>
        <input type="text" class="form-control" value="{{$equipo[0]->modelo}}" readonly>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-4">
        <label for="">Procesador</label>
        <input type="text" class="form-control" value="{{$equipo[0]->procesador}}" readonly>
      </div>
      <div class="form-group col-4">
        <label for="">RAM</label>
        <input type="text" class="form-control" value="{{$equipo[0]->ram}}" readonly>
      </div>
      <div class="form-group col-4">
        <label for="">Disco duro</label>
        <input type="text" class="form-control" value="{{$equipo[0]->disco_duro}}" readonly>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-6">
        <label for="">Número de serie</label>
        <input type="text" class="form-control" value="{{$equipo[0]->ns}}" readonly>
      </div>
      <div class="form-group col-6">
        <label for="">Sistema operativo</label>
        <input type="text" class="form-control" value="{{$equipo[0]->sistema_operativo}}" readonly>
      </div>
    </div>

    <div class="row">
      <div class="form-group col">
        <label for="">MAC Address</label>
        <input type="text" class="form-control" value="{{$equipo[0]->mac}}" readonly>
      </div>
    </div>

    <div class="row">
      <div class="form-group col">
        <label for="">Descripción</label>
        <textarea type="text" class="form-control" readonly>{{$equipo[0]->descripcion}}</textarea>
      </div>
    </div>

    <hr>

  </div>
  @include('admin.equipos.asignarEquipo')
  @include('admin.equipos.editarEquipo')
  <script>
  //Eliminar la relación (por id)
    function eliminarRelacionEquipoPersona(id){
      swal({
            title: "Se eliminará a la persona de este equipo",
            buttons:["Cancelar","OK"],
            icon:'warning'
        })
        .then((value) => {
          if(value){
            $.ajax({
              url:"{{url('equiposPersonas')}}/"+id,
              type:"DELETE",
              data:{"id":id},
              success:function(resp){
                if(resp.ok){
                  swal({
                          title: "Correcto",
                          text: "Se eliminó a la persona de este equipo",
                          icon: "success",
                          button: "OK",
                        });
                        setTimeout(function(){
                          location.reload()
                        },400)
                }else{
                  swal({
                          title: "Error",
                          text: "Error al eliminar a la persona de este equipo",
                          icon: "warning",
                          button: "OK",
                        });
                    console.warn(resp.error)
                }
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
  <script>
  //Eliminar la relación (por id)
    function eliminarEquipo(id){
      swal({
            title: "Se eliminará este equipo",
            buttons:["Cancelar","OK"],
            icon:'warning'
        })
        .then((value) => {
          if(value){
            $.ajax({
              url:"{{url('equipos')}}/"+id,
              type:"DELETE",
              dataType:"JSON",
              data:{"id":id},
              success:function(resp){
                $.each(resp, function(llave,valor){
                  if(valor==1){
                    swal({
                          title: "Correcto",
                          text: "Se eliminó este equipo",
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
