<?php

namespace App\Exports;

use App\Seguimiento;
use Maatwebsite\Excel\Concerns\FromCollection;

class SeguimientosExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Seguimiento::all();
    }
}
