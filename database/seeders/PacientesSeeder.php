<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatosPacientesImport;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $excelFile = storage_path('app/pacientes.xls'); // Asegúrate de que la ruta sea correcta

        Excel::import(new DatosPacientesImport, $excelFile);
    }
}
