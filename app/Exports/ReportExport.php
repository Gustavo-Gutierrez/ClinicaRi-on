<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromCollection, WithStyles, ShouldAutoSize
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
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6C894C']], // Green background
        ]);
        // Apply styles to the header row
        $sheet->getStyle('A3:J3')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6C894C']], // Green background
        ]);


        // Apply styles to data rows
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A4:J' . $highestRow)->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E4F4D3']], // Green background
        ]);
        // Apply styles to data rows
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A4:J' . $highestRow)->applyFromArray([
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E4F4D3']], // Green background
        ]);
    }
    public function collection()
    {
        // Organiza los datos en una colección para exportar a Excel
        $collection = collect([
            // Agrega otras filas según sea necesario
        ]);

        // Agrega las filas del historial médico electrónico
        $collection->push(['Paciente', 'Antecedentes Familiar', 'Antecedente Personal', 'Grupo Sanguineo', 'Raza', 'Sexo', 'Altura']);
        $collection->push([
            $this->data['paciente_nombre'] ?? null,
            $this->data['ant_familiar'] ?? null,
            $this->data['ant_personal'] ?? null,
            $this->data['grupo_sanguineo'] ?? null,
            $this->data['raza'] ?? null,
            $this->data['sexo'] ?? null,
            $this->data['altura'] ?? null,
        ]);
/// Agrega las filas del historial clínico
$collection->push(['Fecha ', 'Consulta', 'Hipotesis Diagnostica', 'Enfermedad Actual']);

for ($i = 0; $i < count($this->data['fecha_hora']); $i++) {
    $collection->push([
        $this->data['fecha_hora'][$i] ?? null,
        $this->data['consultaID'][$i] ?? null,
        $this->data['hip_diagnostico'][$i] ?? null,
        $this->data['enf_actual'][$i] ?? null,
    ]);
}
        

        return $collection;
    }
}
