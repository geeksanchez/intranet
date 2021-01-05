<?php

namespace App\Exports;

use App\Pqrs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PqrsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $pqrs = Pqrs::all();
        return $pqrs;
    }

    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
        return [
            '#',
            'Tipo documento',
            'Documento',
            'Nombre',
            'e-mail',
            'Teléfono',
            'Celular',
            'Aseguradora',
            'Oficina',
            'Servicio',
            'Clasificación',
            'Tipo PQRS',
            'Comentarios',
            'Diligenciado por',
            'Legal',
            'Activo',
            'Usuario',
            'Respuesta',
            'Creado en',
            'Actualizado en',
        ];
    }
}
