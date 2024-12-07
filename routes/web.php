<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AmenidadesController;
use App\Http\Controllers\ServiciosController;


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return 'Bienvenido a la página de inicio';
})->name('home')->middleware('auth');

Route::get('/proyectos', function () {
    return view('proyecto');
});

Route::get('/proyectos', action: [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::get('/proyectos/edit/{id}', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
Route::get('/proyectos/{id}/unidades', action: [ProyectoController::class, 'getUnidades'])->name('proyectos.unidades');
Route::get('/proyectos/find/{id}', [ProyectoController::class, 'find'])->name('proyectos.find');

Route::get('/unidades/{id}', action: [UnidadController::class, 'getUnidad'])->name('Unidades.get');


Route::get('/cotizacion', action: [CotizacionController::class, 'index'])->name('cotizacion.index');
Route::get('/cotizacion/create', [CotizacionController::class, 'create'])->name('cotizacion.create');
Route::post('/cotizacion', [CotizacionController::class, 'store'])->name('cotizacion.store');
Route::get('/cotizacionesList', [CotizacionController::class, 'getCotizaciones'])->name('cotizaciones.list');

Route::resource('amenidades', AmenidadesController::class);
Route::resource('servicios', ServiciosController::class);


Route::get('/pdf', action: [PdfController::class, 'generarPDF'])->name('pdf.generarPDF');
Route::post('/generar-pdf', [PdfController::class, 'generarReportePDF']);



Route::get('/clientes', action: [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/clientes-new', action: [ClienteController::class, 'index2'])->name('cliente.index2');
Route::get('/clientestable', action: [ClienteController::class, 'getclientes'])->name('cliente.table');
Route::get('/cliente/{id}', [ClienteController::class, 'show'])->name('cliente.show');

Route::get('/clientes/create', action: [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');



Route::get('/', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/reset', function () {
    return view('reset');
});


