<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CotizacionController;


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
Route::get('/proyectos/{id}/unidades', [ProyectoController::class, 'getUnidades'])->name('proyectos.unidades');



Route::get('/clientes', function () {
    return view('cliente');
});
Route::get('/add-cliente', function () {
    return view('addcliente');
});


Route::get('/', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/reset', function () {
    return view('reset');
});


Route::get('/cotizacion', action: [CotizacionController::class, 'index'])->name('cotizacion.index');
Route::get('/cotizacion/create', [CotizacionController::class, 'create'])->name('cotizacion.create');

