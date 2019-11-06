<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipo;
use Excel;
use App\Exports\ReporteEquipos;

class ReporteEquiposController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function export()
  {
    $fecha=date("d-m-Y");
    return Excel::download(new ReporteEquipos, 'Inventario de equipos '.$fecha.'.xlsx');
  }
}
