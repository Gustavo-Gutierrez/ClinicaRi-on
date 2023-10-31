<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('vendor.adminlte.auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/whatsapp/webhook', [ChatbotController::class, 'handleIncomingMessage']);

//rutas de los doctores
// Ruta para mostrar el formulario de registro de doctores
Route::get('/doctores/registrar', [App\Http\Controllers\DoctorController::class, 'create'])->name('doctores.create')->middleware('auth');;
// Ruta para almacenar un nuevo doctor
Route::post('/doctores', [App\Http\Controllers\DoctorController::class, 'store'])->name('doctores.store')->middleware('auth');;
// Ruta para mostrar la lista de doctores
Route::get('/doctores1', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctores.index')->middleware('auth');;

Route::get('/administrativos/create', [App\Http\Controllers\AdministrativoController::class, 'create'])->name('administrativos.create')->middleware('auth');;
Route::post('/administrativos', [App\Http\Controllers\AdministrativoController::class, 'store'])->name('administrativos.store')->middleware('auth');;
Route::get('/administrativos', [App\Http\Controllers\AdministrativoController::class, 'index'])->name('administrativos.index')->middleware('auth');;

Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create')->middleware('auth');;
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store')->middleware('auth');;
Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index')->middleware('auth');;

Route::get('/citas/create', [App\Http\Controllers\CitaController::class, 'create'])->name('citas.create')->middleware('auth');;
Route::post('/citas', [App\Http\Controllers\CitaController::class, 'store'])->name('citas.store')->middleware('auth');;
Route::get('/citas', [App\Http\Controllers\CitaController::class, 'index'])->name('citas.index')->middleware('auth');;

Route::get('/buscar-pacientes', 'TuControlador@buscarPacientes');

// Rutas para consultar la lista de consultas
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');

// Rutas para crear una nueva consulta
Route::get('/consultas/crear', [ConsultaController::class, 'create'])->name('consultas.create');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
