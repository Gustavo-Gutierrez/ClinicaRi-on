<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF; // Import the PDF class
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\Factura;
use App\Models\Historial;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\Servicio;
use Carbon\Carbon;
use App\Exports\FacturaExport;

class ReportController extends Controller 
{

    public function index(){
        return view('reportes.index');
    }
    public function generateCSV($historialID)
    {
        $fechaInicio = Carbon::now()->subMonth()->startOfMonth();
        $fechaFinal = Carbon::now()->subMonth()->endOfMonth();

       // $totalFacturado = Factura::whereBetween('Fecha_hora', [$fechaInicio, $fechaFinal])->sum('Total');
    
      // Obtener el historial médico
      $historialMedico = Historial::find($historialID);

      // Obtener el historial clínico
      $historialClinico = HistorialClinico::where('HistorialID', $historialID)->get();


       // Preparar los datos para la exportación
        $data = [
            'altura' => $historialMedico->Altura ?? null,
            'ant_familiar' => $historialMedico->Ant_familiar ?? null,
            'ant_personal' => $historialMedico->Ant_personal ?? null,
            'grupo_sanguineo' => $historialMedico->Grupo_sanguineo ?? null,
            'raza' => $historialMedico->Raza ?? null,
            'sexo' => $historialMedico->Sexo ?? null,
            'paciente_nombre' => $historialMedico->paciente->Nombre ?? null, // Access 'nombre' directly through the relationship

           
        ];

        // Agrega las filas del historial clínico
        
foreach ($historialClinico as $historialC) {

    $data['enf_actual'][] = $historialC->Enf_actual ?? null;
    $data['fecha_hora'][] = $historialC->Fecha_hora ?? null;
    $data['hip_diagnostico'][] = $historialC->Hip_diagnostico ?? null;
    $data['consultaID'][] = $historialC->ConsultaID ?? null;
}

        //dd($data);
        return Excel::download(new ReportExport($data), 'historial_medico.xlsx');
    
    
    }



    public function totalPacientesRegistradosUltimoMes()
{
    $fechaInicio = Carbon::now()->subMonth()->startOfMonth();
    $fechaFinal = Carbon::now()->subMonth()->endOfMonth();

    $totalPacientes = Paciente::count();

    return $totalPacientes;
}
public function totalMontoFacturadoUltimoMes()
{
    $fechaInicio = Carbon::now()->subMonth()->startOfMonth();
    $fechaFinal = Carbon::now()->subMonth()->endOfMonth();

    $totalMontoFacturado = Factura::whereBetween('Fecha_hora', [$fechaInicio, $fechaFinal])->sum('Total');

    return $totalMontoFacturado;
}
public function totalServiciosDadosUltimoMes()
{
    $fechaInicio = Carbon::now()->subMonth()->startOfMonth();
    $fechaFinal = Carbon::now()->subMonth()->endOfMonth();

    $totalServiciosDados = Servicio::whereBetween('Fecha_hora', [$fechaInicio, $fechaFinal])->count();

    return $totalServiciosDados;
}
public function generateFactura()
{
    $fechaInicio = Carbon::now()->subMonth()->startOfMonth();
    $fechaFinal = Carbon::now()->subMonth()->endOfMonth();

    $totalFacturado = Factura::whereBetween('Fecha_hora', [$fechaInicio, $fechaFinal])->sum('Total');

    $data = [
        'fechaInicio' => $fechaInicio,
        'fechaFinal' => $fechaFinal,
        'totalFacturado' => $totalFacturado,
        'otrosDatos' => [
            'totalPacientes' => $this->totalPacientesRegistradosUltimoMes(),
            'totalServicios' => $this->totalServiciosDadosUltimoMes(),
            // ... otros datos
        ],
    ];

    // Use the FacturaExport class to handle the export logic
    return Excel::download(new FacturaExport($data), 'reporteFactura.csv');
}
}

  
