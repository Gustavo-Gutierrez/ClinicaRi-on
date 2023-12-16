<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
/**
 * Class HorarioController
 * @package App\Http\Controllers
 */
class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::paginate();

        return view('horario.index', compact('horarios'))
            ->with('i', (request()->input('page', 1) - 1) * $horarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horario = new Horario();
        return view('horario.create', compact('horario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Horario::$rules);

        $horario = Horario::create($request->all());
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
$action = "Creó un registro nuevo en la tabla Horario";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('horarios.index')
            ->with('success', 'Horario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horario = Horario::find($id);

        return view('horario.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::find($id);

        return view('horario.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Horario $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
       // request()->validate(Horario::$rules);

        $horario->update($request->all());
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
$action = "Edito un Horario";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('horarios.index')
            ->with('success', 'Horario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $horario = Horario::find($id)->delete();
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
$action = "Elimino una Horario"; 
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('horarios.index')
            ->with('success', 'Horario deleted successfully');
    }
}
