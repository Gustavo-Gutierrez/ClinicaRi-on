<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;

class CitaController extends Controller
{
    public function create()
    {
        $pacientes = Paciente::with('user')->get();
        
        $doctors = Doctor::with('user')->get();

        return view('citas.create', compact('pacientes', 'doctors'));
    }
    // Almacenar una nueva cita en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,usuario_id',
            'doctor_id' => 'required|exists:doctors,usuario_id',
            'motivo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);
    
        // Crear una nueva cita usando las relaciones de Eloquent
        Cita::create([
            'paciente_id' => $request->input('paciente_id'),
            'doctor_id' => $request->input('doctor_id'),
            'motivo' => $request->input('motivo'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
        ]);
    
        // Redirigir a la lista de citas con un mensaje de éxito
        return redirect()->route('citas.index')->with('success', 'Cita registrada correctamente');
    }
    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

    public function buscarPacientes(Request $request)
{
    $query = $request->input('query');
    $pacientes = Paciente::where('nombre', 'like', '%' . $query . '%')->get();

    return response()->json($pacientes);
}
}
