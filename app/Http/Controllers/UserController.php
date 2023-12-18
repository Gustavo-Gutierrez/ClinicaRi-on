<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Doctor;
use App\Models\Personal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // request()->validate(User::$rules);

        $user = User::create($request->all());
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
 $action = "Creó un registro nuevo en la tabla usuario";
 $bitacora = Bitacora::create();
 $bitacora->tipou = $tipo;
 $bitacora->name = $user->name;
 $bitacora->actividad = $action;
 $bitacora->fechaHora = date('Y-m-d H:i:s');
 $bitacora->ip = $request->ip();
 $bitacora->save();
 //----------
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //request()->validate(User::$rules);

        
        $user->update($request->all());
//Bitacora
$id2 = Auth::id();
$user1 = User::where('id', $id2)->first();
$tipo = "default";
$doctor =Doctor::where('id', $id2)->first();
$personal =Personal::where('id', $id2)->first();

if ($doctor && $doctor->id == $id2) {
    $tipo = "Doctor";
}

if ($personal && $personal->id == $id2) {
    $tipo = "Enfermera/ro";
}
$action = "Edito al usuario ". " $user->name";
$bitacora = Bitacora::create();
$bitacora->tipou = $tipo;
$bitacora->name = $user1->name;
$bitacora->actividad = $action;
$bitacora->fechaHora = date('Y-m-d H:i:s');
$bitacora->ip = $request->ip();
$bitacora->save();
//----------
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
 //$user = User::find($id)->delete();
// Get the user to be deleted
$userToDelete = User::find($id);

// Delete the user
$userDeleted = User::destroy($id);

if ($userDeleted) {
    //Bitacora
    $id2 = Auth::id();
    $user = User::where('id', $id2)->first();
    $tipo = "default";
    $doctor = Doctor::where('id', $id2)->first();
    $personal = Personal::where('id', $id2)->first();

    if ($doctor && $doctor->id == $id2) {
        $tipo = "Doctor";
    }

    if ($personal && $personal->id == $id2) {
        $tipo = "Enfermera/ro";
    }

    // Get the username from the user to be deleted
    $username = $userToDelete->name;

    $action = "Eliminó un usuario: " . $username;
    $bitacora = Bitacora::create();
    $bitacora->tipou = $tipo;
    $bitacora->name = $user->name;
    $bitacora->actividad = $action;
    $bitacora->fechaHora = now(); // Use Carbon for simplicity
    $bitacora->ip = $request->ip();
    $bitacora->save();
}
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
