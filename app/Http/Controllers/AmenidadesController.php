<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenidades;

class AmenidadesController extends Controller
{

    public function index()
    {
        $amenidades = Amenidades::all();
        return view('amenidades.index', compact('amenidades'));
    }

    // Mostrar formulario para crear una nueva amenidad
    public function create()
    {
        return view('amenidades.create');
    }

    // Guardar una nueva amenidad en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Amenidades::create($request->all());

        return redirect()->route('amenidades.index')->with('success', 'Amenidad creada exitosamente.');
    }

    // Mostrar formulario para editar una amenidad existente
    public function edit($id)
    {
        $amenidad = Amenidades::findOrFail($id);
        return view('amenidades.edit', compact('amenidad'));
    }

    // Actualizar una amenidad existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $amenidad = Amenidades::findOrFail($id);
        $amenidad->update($request->all());

        return redirect()->route('amenidades.index')->with('success', 'Amenidad actualizada exitosamente.');
    }

    // Eliminar una amenidad
    public function destroy($id)
    {
        $amenidad = Amenidades::findOrFail($id);
        $amenidad->delete();

        return redirect()->route('amenidades.index')->with('success', 'Amenidad eliminada exitosamente.');
    }
}
