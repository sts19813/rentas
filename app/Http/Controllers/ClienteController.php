<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Unidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


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

        try {
            DB::beginTransaction();
           

            $validatedData = $request->validate([
                'plaza' => 'required|string',
                'local' => 'required|numeric',
                'fecha_pago' => 'required|string',
                'fecha_vencimiento' => 'required|date',
                'fecha_inicio' => 'required|date',
                'tolerancia' => 'nullable|string',
                'mensualidad' => 'nullable|numeric',
                'nombre' => 'required|string',
                'apellido' => 'nullable|string',
                'fecha_nacimiento' => 'nullable|date',
                'tipo_cliente' => 'nullable|string',
                'correo' => 'required|email',
                'nacionalidad' => 'nullable|string',
                'celular' => 'required|string',
                'ciudad' => 'nullable|string',
                'direccion' => 'nullable|string',
                'pais' => 'nullable|string',
                'estado' => 'nullable|string',
                'ciudad_cliente' => 'nullable|string',
                'codigo_postal' => 'nullable|string',
                'nombre_aval' => 'nullable|string',
                'celular_aval' => 'nullable|string',
                'relacion_aval' => 'nullable|string',
                'nombreR1' => 'nullable|string',
                'celularR1' => 'nullable|string',
                'correoR1' => 'nullable|string',
                'relacionR1' => 'nullable|string',
                'nombreR2' => 'nullable|string',
                'celularR2' => 'nullable|string',
                'correoR2' => 'nullable|string',
                'relacionR2' => 'nullable|string',
                'nombreR3' => 'nullable|string',
                'celularR3' => 'nullable|string',
                'correoR3' => 'nullable|string',
                'relacionR3' => 'nullable|string',
                
            ]);

            $validatedDataNegocio = $request->validate([
                'razon_social' => 'nullable|string',
                'rfc' => 'nullable|string',
                'uso_factura' => 'nullable|string',
                'regimen_fiscal' => 'nullable|string',
                'giro_negocio' => 'nullable|string',
                'correo' => 'nullable|string',
                'cp' => 'nullable|string',
                'direccion_facturacion' => 'nullable|string',
                'pais_facturacion' => 'nullable|string',
                'estado_facturacion' => 'nullable|string',
                'ciudad_facturacion' => 'nullable|string',
                'cp_facturacion' => 'nullable|string',
                'nombre_representante' => 'nullable|string',
                'celular_representante' => 'nullable|string',
                'relacion_representante' => 'nullable|string'
            ]);

            $cliente = Cliente::create($validatedData);
            $cliente->negocio()->create($validatedDataNegocio);

             // Guardar rangos de fechas
             $rangos = $request->input('rangos'); 

             if (!empty($rangos)) {
                 foreach ($rangos as $rango) {
                     // Decodifica el JSON de cada rango en un arreglo asociativo
                     $rangoData = json_decode($rango, true);
             
                     if (is_array($rangoData)) {
                         $cliente->RentPrice()->create([
                             'start_date' => $rangoData['start_date'],
                             'end_date' => $rangoData['end_date'],
                             'price' => $rangoData['price'],
                             'unidad_id' => $request->input('local'),
                         ]);
                     }
                 }
             }

            $unidad = Unidad::find($request->input('local'));
            if ($unidad) {
                $unidad->update(['estatus' => Unidad::ESTATUS['COMPROMETIDO']]);
            }

            if ($request->hasFile('documentos')) {
                foreach ($request->file('documentos') as $documento) {
                    $originalName = pathinfo($documento->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $documento->getClientOriginalExtension();
                    $filename = $originalName . '_' . now()->format('Ymd_His') . '.' . $extension;
                    $documento->move(public_path('documentos'), $filename);
                    $cliente->documentos()->create(['ruta' => 'documentos/' . $filename]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cliente guardado correctamente.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e], 500);
        }
    }

    //funcion para el datatables inicial
    public function getclientes()
    {

        $cliente = Cliente::with(['documentos', 'negocio', 'plaza'])->get();


        // Formatear la respuesta para DataTables
        return response()->json(['data' => $cliente]);
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::with(relations: ['negocio', 'rentPrice', 'documentos'])->findOrFail($id);
        $proyectos = Proyecto::all();
        $isViewMode = true;
        $textTitle = 'Visualizar';

        return view('cliente.show', compact('cliente', 'isViewMode', 'textTitle','proyectos'));
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
