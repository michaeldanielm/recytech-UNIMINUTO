@extends('layouts.app')
@section('titulo')
  Inicio
@endsection
@section('contenedor')
  @include('admin.navegacion')
  <div class="container">
    <div class="row mt-5">
      <a href="{{url('equipos')}}" class="btn btn-info btn-lg p-5 col-6 ">Equipos <i class="fa fa-laptop"></i></a>
      <a href="{{url('impresoras')}}" class="btn btn-secondary btn-lg p-5 col-6">Impresoras <i class="fa fa-print"></i></a>
      <!--<a href="{{route('carpeta.index')}}" class="btn btn-success btn-lg p-5 col-4">Carpetas en red <i class="fa fa-network-wired"></i></a>
    -->
    <a href="{{url('#')}}" class="btn btn-secondary btn-lg p-5 col-6">Celular</a>
	  <a href="{{url('#')}}" class="btn btn-info btn-lg p-5 col-6 ">Equipo Sonido</a>
	  <a href="{{url('#')}}" class="btn btn-info btn-lg p-5 col-6 ">Pantalla Tv</a>
	  <a href="{{url('#')}}" class="btn btn-secondary btn-lg p-5 col-6">Camara</a>
	  <a href="{{url('#')}}" class="btn btn-secondary btn-lg p-5 col-6">Mouse,Teclado,Router</a>
	  <a href="{{url('#')}}" class="btn btn-info btn-lg p-5 col-6 ">Consola de Video Juegos</a>
	  <a href="{{url('#')}}" class="btn btn-info btn-lg p-5 col-6 ">Otro</a>
    </div>
  </div>
@endsection
