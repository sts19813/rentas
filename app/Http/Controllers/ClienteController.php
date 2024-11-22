<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proyecto;
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
                'mes_renta' => 'required|string',
                'plaza' => 'required|string',
                'fecha_pago' => 'required|string',
                'fecha_vencimiento' => 'required|date',
                'local' => 'required|numeric',
                'mensualidad' => 'required|numeric',
                'nombre' => 'required|string',
                'apellido' => 'nullable|string',
                'fecha_nacimiento' => 'nullable|date',
                'tipo_cliente' => 'required|string',
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
                'nombreR1' => 'required|string',
                'celularR1' => 'required|string',
                'correoR1' => 'required|string',
                'relacionR1' => 'nullable|string',
                'nombreR2' => 'required|string',
                'celularR2' => 'required|string',
                'correoR2' => 'required|string',
                'relacionR2' => 'nullable|string',
                'nombreR3' => 'required|string',
                'celularR3' => 'required|string',
                'correoR3' => 'required|string',
                'relacionR3' => 'nullable|string'
            ]);

            $validatedDataNegocio = $request->validate([
                'razon_social' => 'required|string',
                'rfc' => 'required|string',
                'uso_factura' => 'required|string',
                'regimen_fiscal' => 'required|string',
                'giro_negocio' => 'required|string',
                'correo' => 'required|string',
                'cp' => 'required|string',
                'direccion_facturacion' => 'required|string',
                'pais_facturacion' => 'required|string',
                'estado_facturacion' => 'required|string',
                'ciudad_facturacion' => 'required|string',
                'cp_facturacion' => 'required|string',
                'nombre_representante' => 'required|string',
                'celular_representante' => 'required|string',
                'relacion_representante' => 'required|string'
            ]);

            $cliente = Cliente::create($validatedData);
            $cliente->negocio()->create($validatedDataNegocio);

            foreach ($request->file('documentos', []) as $documento) {
                $ruta = $documento->store('documentos');
                $cliente->documentos()->create(['ruta' => $ruta]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cliente guardado correctamente.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Hubo un problema al guardar el cliente y el negocio. Intenta nuevamente.'], 500);
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
        $cliente = Cliente::with(['negocio'])->findOrFail($id);
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
