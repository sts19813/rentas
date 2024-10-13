<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Amenidades;
use App\Models\Servicio;

class ProyectoController extends Controller
{

    //vista principal de proyectos, lista de los proyectos ya creados
    public function index()
    {
        // Recuperar todos los proyectos
        $proyectos = Proyecto::with('unidades')->get();

        // Pasar los proyectos a la vista
        return view('proyectos.index', compact('proyectos'));
    }

    //visualizar un proyecto con la informacion ya registrada
    public function show($id)
    {
        // Recuperar el proyecto con las relaciones necesarias
        $proyecto = Proyecto::with(['unidades', 'mapas', 'amenidades', 'servicios', 'multimedias'])->findOrFail($id);
        $isViewMode = true;
        $textTitle = 'Visualizar';

        $amenidades = Amenidades::all();
        $servicios = Servicio::all();

        // Pasar el proyecto a la vista
        return view('proyectos.show', compact('proyecto', 'isViewMode', 'textTitle', 'amenidades', 'servicios'));
    }

    public function find($id)
    {
        // Recuperar el proyecto con las relaciones necesarias
        $proyecto = Proyecto::with(['unidades', 'mapas', 'amenidades', 'servicios', 'multimedias'])->findOrFail($id);

        return $proyecto;
    }

    //edita un proyecto mostrando su informacion actual
    public function edit($id)
    {
        // Recuperar el proyecto con las relaciones necesarias
        $proyecto = Proyecto::with(['unidades', 'mapas', 'amenidades', 'servicios', 'multimedias'])->findOrFail($id);
        $isViewMode = false;
        $textTitle = 'Editar';

        $amenidades = Amenidades::all();
        $servicios = Servicio::all();


        // Pasar el proyecto a la vista
        return view('proyectos.show', compact('proyecto', 'isViewMode', 'textTitle', 'amenidades', 'servicios'));
    }


    public function create()
    {
        $amenidades = Amenidades::all();
        $servicios = Servicio::all();

        return view('proyectos.addproyecto', compact('amenidades', 'servicios'));
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
            'unidades' => 'required|json',
            'mapas.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'reglamento' => 'required|string',
            'terminos' => 'required|string',

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
            'reglamento' => $validatedData['reglamento'],
            'terminos' => $validatedData['terminos'],
        ]);

        $unidades = json_decode($request->unidades, true);

        //guarda las unidades del proyecto
        foreach ($unidades as $unidad) {
            $proyecto->unidades()->create($unidad);
        }

        //guarda los amenidades y servicios del proyecto
        $proyecto->amenidades()->sync($request->input('amenidades', []));
        $proyecto->servicios()->sync($request->input('servicios', []));


        //guarda las imagenes de los mapas/plantas en el servidor y tambien en la base de datos
        if ($request->hasFile('mapas')) {
            foreach ($request->file('mapas') as $mapa) {
                // Obtener el nombre original del archivo sin la extensión
                $originalName = pathinfo($mapa->getClientOriginalName(), PATHINFO_FILENAME);
                // Obtener la extensión del archivo
                $extension = $mapa->getClientOriginalExtension();
                // Generar un nombre único con la fecha y hora actual
                $filename = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;

                // Guardar el archivo en 'public/mapas'
                $mapa->move(public_path('mapas'), $filename);

                // Guardar la ruta del archivo en la base de datos
                $proyecto->mapas()->create(['ruta_imagen' => 'mapas/' . $filename]);
            }
        }


        if ($request->hasFile('multimedias')) {
            foreach ($request->file('multimedias') as $multimedia) {
                // Obtener el nombre original del archivo sin la extensión
                $originalName = pathinfo($multimedia->getClientOriginalName(), PATHINFO_FILENAME);
                // Obtener la extensión del archivo
                $extension = $multimedia->getClientOriginalExtension();
                // Generar un nombre único con la fecha y hora actual
                $filename = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;

                // Guardar el archivo en 'public/multimedias'
                $multimedia->move(public_path('multimedias'), $filename);

                // Guardar la ruta del archivo en la base de datos
                $proyecto->multimedias()->create(['ruta_multimedia' => 'multimedias/' . $filename]);
            }
        }
        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Proyecto creado con éxito');
    }

    //actualizar el proyecto
    public function update(Request $request, $id)
    {
        // Validar los datos entrantes
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
            'unidades' => 'required|json',
            'mapas.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multimedias.*' => 'image|mimes:jpeg,png,jpg,gif,svg,mp4,avi|max:2048',
            'reglamento' => 'required|string',
            'terminos' => 'required|string',
        ]);

        // Buscar el proyecto por ID
        $proyecto = Proyecto::findOrFail($id);

        // Actualizar los datos del proyecto en la base de datos
        $proyecto->update([
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
            'reglamento' => $validatedData['reglamento'],
            'terminos' => $validatedData['terminos'],
        ]);

        // Actualizar las unidades del proyecto
        $unidades = json_decode($request->unidades, true);
        $proyecto->unidades()->delete(); // Elimina las unidades existentes
        foreach ($unidades as $unidad) {
            $proyecto->unidades()->create($unidad); // Reagrega las nuevas unidades
        }

        // Sincronizar las amenidades y servicios
        $proyecto->amenidades()->sync($request->input('amenidades', []));
        $proyecto->servicios()->sync($request->input('servicios', []));

        // Guardar las nuevas imágenes de mapas si se suben
        if ($request->hasFile('mapas')) {
            foreach ($request->file('mapas') as $mapa) {
                $originalName = pathinfo($mapa->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $mapa->getClientOriginalExtension();
                $filename = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;

                $mapa->move(public_path('mapas'), $filename);
                $proyecto->mapas()->create(['ruta_imagen' => 'mapas/' . $filename]);
            }
        }

        // Guardar las nuevas imágenes/multimedia si se suben
        if ($request->hasFile('multimedias')) {
            foreach ($request->file('multimedias') as $multimedia) {
                $originalName = pathinfo($multimedia->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $multimedia->getClientOriginalExtension();
                $filename = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;

                $multimedia->move(public_path('multimedias'), $filename);
                $proyecto->multimedias()->create(['ruta_multimedia' => 'multimedias/' . $filename]);
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Proyecto actualizado con éxito');
    }


    //obtiene todas las unidad por proyecto
    public function getUnidades($id)
    {
        // Obtener el proyecto por su ID
        $proyecto = Proyecto::with(['unidades', 'servicios', 'amenidades'])->findOrFail($id);
    
        // Obtener las unidades del proyecto
        $unidades = $proyecto->unidades->map(function ($unidad) use ($proyecto) {
            return [
                'nombre' => $unidad->nombre,
                'metros_cuadrados' => $unidad->metros_cuadrados,
                'precio_por_hora' => $unidad->precio_por_hora,
                'precio_por_mes' => $unidad->precio_por_mes,
                'precio_primer_pago' => $unidad->precio_primer_pago,
                'nivel' => $unidad->nivel,
                'estatus' => $unidad->estatus,
                'id' => $unidad->id,
                'servicios' => $proyecto->servicios->map(function ($servicio) {
                    return $servicio->nombre; 
                })->implode(','), 
                'amenidades' => $proyecto->amenidades->map(function ($amenidad) {
                    return $amenidad->nombre; 
                })->implode(','), 
            ];
        });
    
        // Formatear la respuesta para DataTables
        return response()->json(['data' => $unidades]);
    }
    


}
