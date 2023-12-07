<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function indexPacientes()
    {
        $data = Paciente::all();
        return response()->json($data, 200);
    }
    public function showPaciente($id)
    {
        $data = Paciente::find($id);
        if (!$data) {
            return response()->json(['error' => 'No se encontró el recurso'], 404);
        }
        return response()->json($data, 200);
    
}
}
