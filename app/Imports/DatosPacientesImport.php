<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatosPacientesImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Paciente([ 

        
      
        
        'created_at'=>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['created_at']),
        'updated_at'=>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['updated_at']),
        'ci' => $row['ci'],
        'direccion'	=> $row['direccion'],
        'email'	=> $row['email'],
        'estado_civil'	=> $row['estado_civil'],
        'fecha_nacimiento'	=>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']),
        'lugar_nacimiento'	=> $row['lugar_nacimiento'],
        'nacionalidad'	=> $row['nacionalidad'],
        'nombre'	=> $row['nombre'],
        'profesion'	=> $row['profesion'],
        'telefono'	=> $row['telefono'],
        'id'=> $row['id'],
    ]);
    }
}
