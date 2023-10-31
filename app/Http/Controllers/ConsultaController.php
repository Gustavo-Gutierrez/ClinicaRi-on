<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Doctor;
use App\Models\Paciente;


class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('doctor', 'paciente')->get();
        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('consultas.create', compact('doctores', 'pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,usuario_id',
            'paciente_id' => 'required|exists:pacientes,usuario_id',
            'diagnostico' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'instrucciones' => 'required|string|max:255',
            'motivo' => 'required|string|max:255',
            'observacion' => 'nullable|string|max:255',
        ]);

        Consulta::create([
            'paciente_id' => $request->input('paciente_id'),
            'doctor_id' => $request->input('doctor_id'),
            'diagnotico' => $request->input('diagnostico'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'instrucciones' => $request->input('instrucciones'),
            'motivo' => $request->input('motivo'),
            'observacion' => $request->input('observacion'), 
        ]);

        return redirect()->route('consultas.index')->with('success', 'Consulta registrada correctamente');
    }

    public function edit(Consulta $consulta)
    {
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('consultas.edit', compact('consulta', 'doctores', 'pacientes'));
    }

    public function update(Request $request, Consulta $consulta)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,usuario_id',
            'paciente_id' => 'required|exists:pacientes,usuario_id',
            'diagnostico' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'instrucciones' => 'required|string|max:255',
            'motivo' => 'required|string|max:255',
            'observacion' => 'nullable|string|max:255',
        ]);

        $consulta->update($request->all());

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente');
    }
}
