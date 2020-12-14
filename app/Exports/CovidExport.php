<?php

namespace App\Exports;

use App\Covid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CovidExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Covid::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Creado en',
            'Actualizado en',
        ];
    }
}
