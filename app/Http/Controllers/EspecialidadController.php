<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
/**
 * Class EspecialidadController
 * @package App\Http\Controllers
 */
class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidads = Especialidad::paginate();

        return view('especialidad.index', compact('especialidads'))
            ->with('i', (request()->input('page', 1) - 1) * $especialidads->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidad = new Especialidad();
        return view('especialidad.create', compact('especialidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Especialidad::$rules);

        $especialidad = Especialidad::create($request->all());
//Bitacora
$id2 = Auth::id();
$user = User::where('id', $id2)->first();
$tipo = "default";
$doctor =Doctor::where('id', $id2)->first();
$personal =Personal::where('id', $id2)->first();

if ($doctor && $doctor->id == $id2) {
    $tipo = "Doctor";
}

if ($personal && $personal->id == $id2) {
    $tipo = "Enfermera/ro";
}
$action = "Creó un registro nuevo en la tabla Especialidad";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('especialidads.index')
            ->with('success', 'Especialidad created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidad = Especialidad::find($id);

        return view('especialidad.show', compact('especialidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especialidad = Especialidad::find($id);

        return view('especialidad.edit', compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Especialidad $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        //request()->validate(Especialidad::$rules);

        $especialidad->update($request->all());
//Bitacora
$id2 = Auth::id();
$user = User::where('id', $id2)->first();
$tipo = "default";
$doctor =Doctor::where('id', $id2)->first();
$personal =Personal::where('id', $id2)->first();

if ($doctor && $doctor->id == $id2) {
    $tipo = "Doctor";
}

if ($personal && $personal->id == $id2) {
    $tipo = "Enfermera/ro";
}
$action = "Edito un registro en la tabla Especialidad ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('especialidads.index')
            ->with('success', 'Especialidad updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::find($id)->delete();
        //Bitacora
        $id2 = Auth::id();
        $user = User::where('id', $id2)->first();
        $tipo = "default";
        $doctor =Doctor::where('id', $id2)->first();
        $personal =Personal::where('id', $id2)->first();
        
        if ($doctor && $doctor->id == $id2) {
            $tipo = "Doctor";
        }
        
        if ($personal && $personal->id == $id2) {
            $tipo = "Enfermera/ro";
        }
        $action = "Elimino un registro en la tabla Especialidad ";
        $bitacora = Bitacora::create();
        $bitacora->tipou = $tipo;
        $bitacora->name = $user->name;
        $bitacora->actividad = $action;
        $bitacora->fechaHora = date('Y-m-d H:i:s');
        $bitacora->ip = $request->ip();
        $bitacora->save();
        //----------
        return redirect()->route('especialidads.index')
            ->with('success', 'Especialidad deleted successfully');
    }
}
