<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeController;
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
Route::post('/speech_to_text', [App\Http\Controllers\HomeController::class, 'speechToText'])->name('speech_to_text');

Route::get('/cargar_excel', [App\Http\Controllers\ExcelController::class, 'cargarExcel']);

