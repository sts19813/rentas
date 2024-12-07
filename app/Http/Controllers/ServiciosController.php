<?php

namespace App\Http\Controllers;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
     // Mostrar todos los servicios
     public function index()
     {
         $servicios = Servicio::all();
         return view('servicios.index', compact('servicios'));
     }
 
     // Mostrar formulario para crear un nuevo servicio
     public function create()
     {
         return view('servicios.create');
     }
 
     // Guardar un nuevo servicio en la base de datos
     public function store(Request $request)
     {
         $request->validate([
             'nombre' => 'required|string|max:255',
         ]);
 
         Servicio::create($request->all());
 
         return redirect()->route('servicios.index')->with('success', 'Servicio creado exitosamente.');
     }
 
     // Mostrar formulario para editar un servicio existente
     public function edit($id)
     {
         $servicio = Servicio::findOrFail($id);
         return view('servicios.edit', compact('servicio'));
     }
 
     // Actualizar un servicio existente
     public function update(Request $request, $id)
     {
         $request->validate([
             'nombre' => 'required|string|max:255',
         ]);
 
         $servicio = Servicio::findOrFail($id);
         $servicio->update($request->all());
 
         return redirect()->route('servicios.index')->with('success', 'Servicio actualizado exitosamente.');
     }
 
     // Eliminar un servicio
     public function destroy($id)
     {
         $servicio = Servicio::findOrFail($id);
         $servicio->delete();
 
         return redirect()->route('servicios.index')->with('success', 'Servicio eliminado exitosamente.');
     }
}
