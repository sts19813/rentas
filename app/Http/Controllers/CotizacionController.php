<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Amenidades;
use App\Models\Servicio;

class CotizacionController extends Controller
{
    public function index()
    {
        // Recuperar todos los proyectos
        $proyectos = Proyecto::with('unidades')->get();

        // Pasar los proyectos a la vista
        return view('cotizacion.index', compact('proyectos'));
    }

    //mustra la vista de creacion
    public function create()
    {
        $proyectos = Proyecto::with('unidades')->get();

        return view('cotizacion.addcotizacion', compact('proyectos'));
    }
}
