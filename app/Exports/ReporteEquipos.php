<?php

namespace App\Exports;

use App\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReporteEquipos implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.excel.reporteEquipos', [
            'equipos' => Equipo::with('equipoPersona')
                            ->with('equipoPersona.persona')
                            ->with('equipoPersona.persona.ubicacion')
                            ->get()
        ]);
    }
}
