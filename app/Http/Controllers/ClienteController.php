<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proyecto;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));
    }

    public function index2()
    {
        $clientes = Cliente::all();
        return view('cliente.new_index', compact('clientes'));
    }

    public function create()
    {
        $proyectos = Proyecto::all();

        return view('cliente.create', compact('proyectos'));
    }


    // Guardar un nuevo cliente
    public function store(Request $request)
    {
    
        $cliente = Cliente::create($request->only([
            'mes_renta', 'plaza', 'fecha_pago', 'fecha_vencimiento', 'local', 
            'mensualidad', 'nombre_completo', 'fecha_nacimiento', 'tipo_cliente',
            'correo', 'nacionalidad', 'celular', 'ciudad', 'direccion', 
            'pais', 'estado', 'ciudad_cliente', 'codigo_postal', 
            'nombre_aval', 'celular_aval', 'relacion_aval'
        ]));

        $cliente->negocio()->create($request->only([
            'razon_social', 'rfc', 'uso_factura', 'regimen_fiscal', 
            'giro_negocio', 'correo', 'cp', 'direccion_facturacion', 
            'pais_facturacion', 'estado_facturacion', 'ciudad_facturacion', 
            'cp_facturacion', 'nombre_representante', 'celular_representante', 
            'relacion_representante'
        ]));

        foreach ($request->input('referencias', []) as $referencia) {
            $cliente->referencias()->create($referencia);
        }

        foreach ($request->file('documentos', []) as $documento) {
            $ruta = $documento->store('documentos');
            $cliente->documentos()->create(['ruta' => $ruta]);
        }

        return redirect()->back()->with('success', 'Cliente guardado correctamente.');
    }



    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar el formulario para editar un cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'tipo_cliente' => 'required|in:persona_fisica,persona_moral',
            'celular' => 'required|string',
            'correo' => 'required|email',
            'fecha_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string',
            'ciudad' => 'nullable|string',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
