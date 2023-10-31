<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function index()
    {
       
       $pacientes = Paciente::with('user')->get();
        return view('Pacientes.index', compact('pacientes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'estado_civil' => 'nullable|string|max:255',
            'lugar_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'profesion' => 'nullable|string|max:255',
            'raza' => 'nullable|string|max:255',
            'residencia_actual' => 'nullable|string|max:255',
            'grupo_sanguineo_abo' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'tipo' => 'Paciente',
            'rolID'=> 1,
        ]);

        Paciente::create([
            'usuario_id' => $user->id,
            'estado_civil' => $request->input('estado_civil'),
            'lugar_nacimiento' => $request->input('lugar_nacimiento'), 
            'nacionalidad' => $request->input('nacionalidad'),
            'profesion' => $request->input('profesion'),
            'raza' => $request->input('raza'),
            'residencia_actual' => $request->input('residencia_actual'),
            'grupo_sanguineo_abo' => $request->input('grupo_sanguineo_abo'),

            

        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
