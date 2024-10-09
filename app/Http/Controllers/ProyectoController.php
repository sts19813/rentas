<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Amenidades;
use App\Models\Servicio;

class ProyectoController extends Controller
{
    /**
     * Muestra el formulario de creación de proyectos.
     */
    public function create()
    {
        $amenidades = Amenidades::all();
        $servicios = Servicio::all();

        return view('addproyecto', compact('amenidades', 'servicios'));
    }

    /**
     * Almacena un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {

        //dd($request);
        $validatedData = $request->validate([
            'nombrePlaza' => 'required|string|max:255',
            'cantidadLocales' => 'required|integer',
            'cantidadCajones' => 'required|integer',
            'precioRenta' => 'nullable|numeric',
            'cuotaMantenimiento' => 'required|numeric',
            'nivelesPlaza' => 'required|integer',
            'horaApertura' => 'required',
            'horaCierre' => 'required',
            'direccion1' => 'required|string',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'codigoPostal' => 'required|string',
            'amenidades' => 'array',
            'servicios' => 'array',
        ]);

          // Guardar el proyecto en la base de datos
          $proyecto = Proyecto::create([
            'nombre' => $validatedData['nombrePlaza'],
            'cantidad_locales' => $validatedData['cantidadLocales'],
            'cantidad_cajones' => $validatedData['cantidadCajones'],
            'precio_renta' => $validatedData['precioRenta'],
            'cuota_mantenimiento' => $validatedData['cuotaMantenimiento'],
            'niveles' => $validatedData['nivelesPlaza'],
            'hora_apertura' => $validatedData['horaApertura'],
            'hora_cierre' => $validatedData['horaCierre'],
            'direccion1' => $validatedData['direccion1'],
            'pais' => $validatedData['pais'],
            'estado' => $validatedData['estado'],
            'ciudad' => $validatedData['ciudad'],
            'codigo_postal' => $validatedData['codigoPostal'],
        ]);

        $proyecto->amenidades()->sync($request->input('amenidades', []));
        $proyecto->servicios()->sync($request->input('servicios', []));

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Proyecto creado con éxito');
    }
}
