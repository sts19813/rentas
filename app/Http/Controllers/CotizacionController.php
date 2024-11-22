<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cotizacion;
use App\Models\Cliente;

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

    //genera la cotizacion, 
    //crea el registro en cliente como prospecto
    //guarda el registro en cotizacion para reinprimir y notificar
    public function store(Request $request)
    {

        // Validar los datos que vienen en la solicitud
        $validatedData = $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'unidad_id' => 'required|exists:unidades,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'tipo_cliente' => 'required|in:persona_fisica,persona_moral',
            'celular' => 'required|string|max:20',
            'correo' => 'required',
            'primer_pago' => 'required|numeric',
            'tipo_renta' => 'required|in:hora,dia,mes,año',
            'duracion' => 'nullable|integer',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'date',
            'total' => 'required|numeric',
        
        ]);

        // Guardar el cliente como prospecto
        /*
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'tipo_cliente' => $request->tipo_cliente,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'fecha_nacimiento' => '1900-01-01',
            'ciudad' => '',
            'nacionalidad' => '',
        ]);
        */
        $cotizacion = Cotizacion::create($validatedData);

        // Retornar una respuesta de éxito
        return response()->json(['message' => 'Cotización creada exitosamente'], 201);

    }


    public function getCotizaciones()
    {
        $cotizaciones = Cotizacion::with('proyecto', 'unidad')->get();

        // Aquí puedes ajustar los datos para que coincidan con las columnas de la tabla
        $data = $cotizaciones->map(function ($cotizacion) {
            return [
                'cliente' => $cotizacion->nombre . ' ' . $cotizacion->apellido,
                'negocio' => 'no disponible',
                'plaza' => $cotizacion->proyecto->nombre, 
                'local' => $cotizacion->Unidad->nombre,
                'estatus' => '<span class="badge status-active">Activo</span>',
                'opciones' => '
                <button class="btn btn-success btn-sm">Ver</button>
                <button class="btn btn-primary btn-sm">Reporte</button>
                <button class="btn btn-warning btn-sm">Correo</button>
            ',
            ];
        });

        return response()->json(['data' => $data]);
    }
}
