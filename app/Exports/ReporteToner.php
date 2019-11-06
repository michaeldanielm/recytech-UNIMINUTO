<?php

namespace App\Exports;

use App\InventarioCartuchos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReporteToner implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Cartucho::all();
    // }
    public function view(): View
    {
        return view('admin.excel.reporteToner', [
            'toners' => InventarioCartuchos::all()
        ]);
    }
}
