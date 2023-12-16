<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
/**
 * Class EquipoController
 * @package App\Http\Controllers
 */
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::paginate();

        return view('equipo.index', compact('equipos'))
            ->with('i', (request()->input('page', 1) - 1) * $equipos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipo = new Equipo();
        return view('equipo.create', compact('equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Equipo::$rules);

        $equipo = Equipo::create($request->all());
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
$action = "Creó un registro nuevo en la tabla Equipo";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipos.index')
            ->with('success', 'Equipo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo = Equipo::find($id);

        return view('equipo.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo = Equipo::find($id);

        return view('equipo.edit', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        //request()->validate(Equipo::$rules);

        $equipo->update($request->all());
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
$action = "Edito un registro en la tabla Equipo ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipos.index')
            ->with('success', 'Equipo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id)->delete();
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
$action = "Elimino un registro en la tabla Equipo ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipos.index')
            ->with('success', 'Equipo deleted successfully');
    }
}
