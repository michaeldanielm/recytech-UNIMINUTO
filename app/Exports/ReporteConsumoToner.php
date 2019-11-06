<?php

namespace App\Exports;

use App\RegistroConsumo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class ReporteConsumoToner implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.excel.reporteConsumoToner', [
            'consumo' => RegistroConsumo::all()
        ]);
    }
}
