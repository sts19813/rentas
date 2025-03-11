<?php

use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AmenidadesController;
use App\Http\Controllers\ServiciosController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {

    $user_google = Socialite::driver('google')->stateless()->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();

    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


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


});

Route::get('/login2', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});

require __DIR__ . '/auth.php';
