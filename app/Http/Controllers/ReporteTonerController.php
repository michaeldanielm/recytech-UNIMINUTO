<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartucho;
use App\RegistroConsumoToner;
use Excel;
use App\Exports\ReporteToner;
use App\Exports\ReporteConsumoToner;
class ReporteTonerController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function export()
  {
    $fecha=date('d-m-Y');
    return Excel::download(new ReporteToner, 'Inventario de toner '.$fecha.'.xlsx');
  }
  public function exportConsumo(){
    $fecha=date('d-m-Y');
    return Excel::download(new ReporteConsumoToner, 'Registro de consumo de toner '.$fecha.'.xlsx');
  }
}
