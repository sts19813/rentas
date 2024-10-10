<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;

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

Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');



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

Route::get('/cotizacion', function () {
    return view('cotizacion');
});

Route::get('/add-cotizacion', function () {
    return view('addcotizador');
});