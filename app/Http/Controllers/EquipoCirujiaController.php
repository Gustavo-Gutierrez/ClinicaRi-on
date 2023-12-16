<?php

namespace App\Http\Controllers;

use App\Models\EquipoCirujia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
/**
 * Class EquipoCirujiaController
 * @package App\Http\Controllers
 */
class EquipoCirujiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipoCirujias = EquipoCirujia::paginate();

        return view('equipo-cirujia.index', compact('equipoCirujias'))
            ->with('i', (request()->input('page', 1) - 1) * $equipoCirujias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipoCirujia = new EquipoCirujia();
        return view('equipo-cirujia.create', compact('equipoCirujia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(EquipoCirujia::$rules);

        $equipoCirujia = EquipoCirujia::create($request->all());
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
$action = "Creó un registro nuevo en la tabla EquipoCirujia";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipo-cirujias.index')
            ->with('success', 'EquipoCirujia created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipoCirujia = EquipoCirujia::find($id);

        return view('equipo-cirujia.show', compact('equipoCirujia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipoCirujia = EquipoCirujia::find($id);

        return view('equipo-cirujia.edit', compact('equipoCirujia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EquipoCirujia $equipoCirujia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipoCirujia $equipoCirujia)
    {
        //request()->validate(EquipoCirujia::$rules);

        $equipoCirujia->update($request->all());
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
$action = "Edito un registro en la tabla EquipoCirujia ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipo-cirujias.index')
            ->with('success', 'EquipoCirujia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $equipoCirujia = EquipoCirujia::find($id)->delete();
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
$action = "Elimino un registro en la tabla EquipoCirujia ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('equipo-cirujias.index')
            ->with('success', 'EquipoCirujia deleted successfully');
    }
}
