<?php

namespace App\Exports;

use App\Models\Factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FacturaExport implements FromCollection, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // Implement the styles method
    public function styles(Worksheet $sheet)
    {
        // Apply styles to the header row
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6C894C']], // Green background
        ]);
        $sheet->getStyle('A3:H3')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6C894C']], // Green background
        ]);

        // Apply styles to data rows
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A4:H' . $highestRow)->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E4F4D3']], // Green background
        ]);
        
    }

    public function collection()
    {
        // Organiza los datos en una colección para exportar a Excel
        $collection = collect([
            // Agrega la fila adicional al comienzo con el título
            ['', '', '', '', '', '', 'Número de Facturas', count($this->data['facturas'])],
            ['', '', '', '', '', '', 'Total Dinero Movido', $this->data['totalFacturado']],
            // Agrega las filas de las facturas
            ['ID', 'Ci', 'Descuento', 'Fecha_hora', 'Nit', 'Nombre', 'Total', 'ServicioID'],
        ]);

        foreach ($this->data['facturas'] as $factura) {
            $collection->push([
                $factura->id ?? null,
                $factura->Ci ?? null,
                $factura->Descuento ?? null,
                $factura->Fecha_hora ?? null,
                $factura->Nit ?? null,
                $factura->Nombre ?? null,
                $factura->Total ?? null,
                $factura->ServicioID ?? null,
            ]);
        }

        return $collection;
    }
}


