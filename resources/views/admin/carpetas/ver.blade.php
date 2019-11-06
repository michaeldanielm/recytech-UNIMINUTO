@extends('layouts.app')
@section('titulo')
  Carpeta {{$carpeta->id}}
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container">
    <h1 class="display-5 mt-3">Carpeta: {{$carpeta->nombre_carpeta}}</h1>
    <button class="btn btn-danger float-right" onclick="eliminar()"><i class="fa fa-trash"></i></button>
    <div id="msg"></div>
    <hr>
    <form id="editarCarpeta" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="nombre_carpeta">Nombre</label>
                <input type="text" class="form-control" id="nombre_carpeta" value="{{$carpeta->nombre_carpeta}}" name="nombre_carpeta">
            </div>
            <div class="form-group col-sm-6">
                <label for="ruta">Ruta</label>
                <input type="text" class="form-control" id="ruta" value="{{$carpeta->ruta}}" name="ruta">
            </div>
                  
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" value="{{$carpeta->usuario}}" name="usuario">
            </div>   
            <div class="form-group col-sm-6">
                <label for="contrasena">Contraseña</label>
                <input type="text" class="form-control" id="contrasena" value="{{$carpeta->contrasena}}" name="contrasena">
            </div>         
        </div>

        <div class="row">
                <div class="form-group col-sm-6">
                    <label for="">Planta:</label>
                    <input type="text" class="form-control" name="planta" value="{{$carpeta->planta}}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">Departamento:</label>
                    <input type="text" class="form-control" name="departamento" value="{{$carpeta->departamento}}">
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="">Acceso:</label>
                    <select name="acceso" id="" class="form-control">
                        <option {{$carpeta->acceso=='Privado' ? 'selected' : ''}} value="Privado">Privado</option>
                        <option {{$carpeta->acceso=='Público' ? 'selected' : ''}} value="Público">Público</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Permisos:</label>
                    <select name="permisos" id="" class="form-control">
                        <option {{$carpeta->permisos=='Lectura/Escritura' ? 'selected' : ''}} value="Lectura/Escritura">Lectura/Escritura</option>
                        <option {{$carpeta->permisos=='Lectura' ? 'selected' : ''}} value="Lectura">Solo lectura</option>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Papelera de reciclaje activa:</label>
                    <select name="papelera" id="" class="form-control">
                        <option {{$carpeta->papelera==1 ? 'selected' : ''}} value="1">Sí</option>
                        <option {{$carpeta->papelera==0 ? 'selected' : ''}} value="0">No</option>
                    </select>
                </div>
            </div>
          
            <div class="form-group">
                <label for="">Solicitantes</label>
                <textarea name="solicitantes" class="form-control" >{{$carpeta->solicitantes}}</textarea>
            </div>
            <button class="btn btn-block btn-primary">Guardar <i class="fa fa-save"></i></button>
    </form>

  </div>

    <script>
        $("#editarCarpeta").submit(function(){
            event.preventDefault();
            $.ajax({
                url:"{{route('carpeta.update',$carpeta->id)}}",
                type:"PUT",
                data: $("#editarCarpeta").serialize(),
                success:function(res){
                    if(res.ok){
                        Swal.fire(
                            "Correcto",
                            "Se actualizó la carpeta",
                            "success"
                        ) 
                        setTimeout(function(){
                            location.reload()
                        },500)
                        
                    }else{
                        Swal.fire(
                            "Error",
                            "No se actualizó",
                            "warning"
                        ) 
                        $("#msg").html('<div class="alert alert-warning">Error: '+res.error+'</div>')
                    }
                },
                error:function(err){
                    Swal.fire(
                            "Error",
                            "No se actualizó",
                            "error"
                        ) 
                        $("#msg").html('<div class="alert alert-danger">Error: '+err.error+'</div>')
                        console.warn(err)
                }
            })
        })

        function eliminar(){
            Swal.fire({
                title: 'Se eliminará el registro',
                text: "¿Deseas continuar?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:"{{route('carpeta.destroy',$carpeta->id)}}",
                            data:{"_token":"{{csrf_token()}}"},
                            type:"DELETE",
                            success:function(res){
                                    if(res.ok){
                                        Swal.fire(
                                        "Correcto",
                                        "Se eliminó el registró",
                                        "success"
                                        )
                                    setTimeout(function(){
                                        location.href="{{route('carpeta.index')}}"
                                    },700)
                                }else{
                                    Swal.fire(
                                        "Error",
                                        "No se eliminó",
                                        "warning"
                                    ) 
                                    $("#msg").html('<div class="alert alert-warning">Error: '+res.error+'</div>')
                                }
                                
                            },
                            error:function(err){
                                Swal.fire(
                                        "Error",
                                        "No se eliminó",
                                        "error"
                                    ) 
                                    $("#msg").html('<div class="alert alert-danger">Error: '+err.error+'</div>')
                                    console.warn(err)
                            }
                        })
                    }
                })
        }
    </script>

@endsection
