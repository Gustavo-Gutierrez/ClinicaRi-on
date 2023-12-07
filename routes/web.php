<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HistorialController;

use App\Http\Controllers\HomeController;
//controlador de la IA de reconocimiento de imagen
use App\Http\Controllers\OCRController;
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
    return view('welcome');
});

Route::get('/login', function () {
    return view('vendor.adminlte.auth.login');
});
Route::get('/register', function () {
    return view('vendor.adminlte.auth.register');
});
Auth::routes();

Route::prefix('/admin')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])
    ->middleware('checkRole:Administrador')
    ->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])
    ->middleware('checkRole:Administrador')
    ->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store']);

    Route::get('/roles/edit/{user}', [App\Http\Controllers\RoleController::class, 'edit'])
    ->middleware('checkRole:Administrador')
    ->name('roles.edit');
    Route::put('/roles/edit/{user}', [App\Http\Controllers\RoleController::class, 'update'])
    ->middleware('checkRole:Administrador')
    ->name('roles.update');

    });
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])
    ->middleware('checkRole:Administrador')
    ->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])
    ->middleware('checkRole:Administrador')
    ->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store']);

    Route::get('/roles/edit/{user}', [App\Http\Controllers\RoleController::class, 'edit'])
    ->middleware('checkRole:Administrador')
    ->name('roles.edit');
    Route::put('/roles/edit/{user}', [App\Http\Controllers\RoleController::class, 'update'])
    ->middleware('checkRole:Administrador')
    ->name('roles.update');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/whatsapp/webhook', [ChatbotController::class, 'handleIncomingMessage']);

//rutas de los doctores
// Ruta para mostrar el formulario de registro de doctores
Route::get('/doctores/registrar', [App\Http\Controllers\DoctorController::class, 'create'])->name('doctores.create')->middleware('auth');
// Ruta para almacenar un nuevo doctor
Route::post('/doctores', [App\Http\Controllers\DoctorController::class, 'store'])->name('doctores.store')->middleware('auth');
// Ruta para mostrar la lista de doctores
Route::get('/doctores1', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctores.index')->middleware('auth');

Route::get('/administrativos/create', [App\Http\Controllers\AdministrativoController::class, 'create'])->name('administrativos.create')->middleware('auth');
Route::post('/administrativos', [App\Http\Controllers\AdministrativoController::class, 'store'])->name('administrativos.store')->middleware('auth');
Route::get('/administrativos', [App\Http\Controllers\AdministrativoController::class, 'index'])->name('administrativos.index')->middleware('auth');

Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create')->middleware('auth');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store')->middleware('auth');
Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index')->middleware('auth');

Route::get('/citas/create', [App\Http\Controllers\CitaController::class, 'create'])->name('citas.create')->middleware('auth');
Route::post('/citas', [App\Http\Controllers\CitaController::class, 'store'])->name('citas.store')->middleware('auth');
Route::get('/citas', [App\Http\Controllers\CitaController::class, 'index'])->name('citas.index')->middleware('auth');

Route::get('/buscar-pacientes', 'TuControlador@buscarPacientes');

// Rutas para consultar la lista de consultas
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index')->middleware('auth');

// Rutas para crear una nueva consulta
Route::get('/consultas/crear', [ConsultaController::class, 'create'])->name('consultas.create')->middleware('auth');
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store')->middleware('auth');

Route::post('/speech_to_text', [App\Http\Controllers\HomeController::class, 'speechToText'])->name('speech_to_text');

Route::get('/cargar_excel', [App\Http\Controllers\ExcelController::class, 'cargarExcel']);
Route::get('/historial/edit', [App\Http\Controllers\HistorialController::class, 'edit'])->name('historial.edit');



/*****GENERADO PARA LOS CRUDS****/

Route::resource('equipos', EquipoController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('administrativos', AdministrativoController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('citas', CitaController::class);
Route::resource('consultas', ConsultaController::class);
Route::resource('roles', RoleController::class);
Route::resource('historials', HistorialController::class);
Route::resource('especialidads', EspecialidadController::class);
Route::resource('horarios', HorarioController::class);
Route::resource('turnos', TurnoController::class);
Route::resource('turno_horarios', TurnoHorarioController::class);


//rutas de la IA de reconocimiento de imagen
Route::post('imageOCR', [OCRController::class, 'imageOCR'])->name('imageOCR');
Route::get('archivo', [OCRController::class, 'index'])->name('index');

