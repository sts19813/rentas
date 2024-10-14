<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use PDF;

class PdfController extends Controller
{
    //


    public function generarPDF()
    {

        $proyectos = Proyecto::with('unidades')->get();

        // Pasar los proyectos a la vista

        $pdf = \Barryvdh\DomPDF\PDF::loadView('proyectos.index', compact('proyectos') );
        
        return $pdf->download('test.pdf');
    }
}
