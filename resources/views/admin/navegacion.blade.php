<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#243f59!important;">
  <a class="navbar-brand" href="{{route('inicio')}}">Recytech</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
  
      <li class="nav-item">
        <a class="nav-link" href="{{url('equipos')}}">Equipos <i class="fa fa-laptop"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('impresoras')}}">Impresoras <i class="fa fa-print"></i></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="{{route('carpeta.index')}}">Carpetas en red <i class="fa fa-folder-open"></i></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Celular <i class="fa fa-mobile"></i></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Equipo Sonido <i class="fa fa-volume-down"></i></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Pantalla Tv <i class="fa fa-tv"></i></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Camara <i class="fa fa-camera-retro"></i></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Consola de Video Juegos<i class="fa fa-gamepad"></i></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{url('#')}}">Otro<i class="fa fa-microchip"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarReporte" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-list"></i> Reportes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarReporte">
          <a class="dropdown-item" href="{{route('reporteToner')}}">Reporte de toner</a>
          <a class="dropdown-item" href="{{route('reporteEquipos')}}">Reporte de equipos</a>
          <a class="dropdown-item" href="{{route('reporteConsumoToner')}}">Reporte de consumo de toner</a>
        </div>
      </li>

    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle"></i> {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <form method="post">
            <a class="dropdown-item" href="{{url('logout')}}">Cerrar sesión</a>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

{{-- @include('admin.catalogosAjax.ubicaciones') --}}
