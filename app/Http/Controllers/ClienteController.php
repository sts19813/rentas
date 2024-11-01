<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

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

    public function create()
    {
        return view('clientes.create');
    }


    // Guardar un nuevo cliente
    public function store(Request $request)
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

        $cliente = Cliente::create($request->all());

        // Guardar referencias
        foreach (range(1, 3) as $index) {
            $cliente->referencias()->create([
                'nombre' => $request->input("referencia{$index}Nombre"),
                'celular' => $request->input("referencia{$index}Celular"),
                'correo' => $request->input("referencia{$index}Correo"),
                'relacion' => $request->input("referencia{$index}Relacion"),
            ]);
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
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
