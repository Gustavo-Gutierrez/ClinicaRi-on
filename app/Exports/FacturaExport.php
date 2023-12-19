<?php

namespace App\Exports;

use App\Models\Factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacturaExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return Factura::whereBetween('Fecha_hora', [$this->data['fechaInicio'], $this->data['fechaFinal']])
            ->select('Ci', 'Descuento', 'Fecha_hora', 'Nit', 'Nombre', 'Total')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Ci',
            'Descuento',
            'Fecha_hora',
            'Nit',
            'Nombre',
            'Total',
        ];
    }
}
