<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    //


    public function generarPDF()
    {

        $proyectos = Proyecto::with('unidades')->get();


        $pdf = PDF::loadView('proyectos.index', compact('proyectos'));

        return $pdf->download('test.pdf');
    }

    public function generarReportePDF(Request $request)
    {

        $servicios = explode(',', $request->servicios);

        $data = [
            'nombreUnidad' => $request->nombreUnidad,
            'nombrePlaza' => $request->nombrePlaza,
            'precioRentaMes' => $request->precioRentaMes,
            'precioRentaHr' => $request->precioRentaHr,
            'primerPago' => $request->primerPago,
            'tiempoRenta' => $request->tiempoRenta,
            'total' => $request->total,
            'horaApertura' => $request->horaApertura,
            'horaCierre' => $request->horaCierre,
            'mapaCotizacion' => $request->mapaCotizacion,
            'mapaMultimedia' => $request->mapaMultimedia,
            'servicios' => $servicios, // Ejemplo de array
        ];

       

        $pdf = Pdf::loadView('reportes.cotizacion', $data);
        return $pdf->download('cotizacion.pdf');
    }
}
