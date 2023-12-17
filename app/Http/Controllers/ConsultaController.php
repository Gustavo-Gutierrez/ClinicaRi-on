<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
/**
 * Class ConsultaController
 * @package App\Http\Controllers
 */
class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = Consulta::paginate();
       

        return view('consulta.index', compact('consultas'))
            ->with('i', (request()->input('page', 1) - 1) * $consultas->perPage());
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consulta = new Consulta();
        return view('consulta.create', compact('consulta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Consulta::$rules);

        $consulta = Consulta::create($request->all());
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
$action = "Creó un registro nuevo en la tabla Consulta";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('consultas.index')
            ->with('success', 'Consulta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consulta = Consulta::find($id);

        return view('consulta.show', compact('consulta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consulta = Consulta::find($id);

        return view('consulta.edit', compact('consulta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Consulta $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        //request()->validate(Consulta::$rules);

        $consulta->update($request->all());
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
$action = "Edito una Consulta ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('consultas.index')
            ->with('success', 'Consulta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $consulta = Consulta::find($id)->delete();
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
$action = "Elimino una Consulta ";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('consultas.index')
            ->with('success', 'Consulta deleted successfully');
    }
}
