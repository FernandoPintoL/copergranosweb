<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\Persona;
use http\Client\Curl\User;
use http\Env\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{
    protected  $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('CLIENTE');
        $this->editar = $this->user->canEditar('CLIENTE');
        $this->eliminar = $this->user->canEliminar('CLIENTE');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Cliente::with('persona')->whereHas('persona', function ($q) use ($query) {
            $q->where('nit', 'LIKE', "%{$query}%");
        })->orWhere('tipo_cliente', 'LIKE', "%{$query}%")->get();
        return response()->json($result);
    }
    public function index()
    {
        return Inertia::render("Cliente/Index", [
            'listado' => Cliente::with('persona')->get(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            'flash' => [
                'error' => session('error'),
                'success' => session('success')
            ],// Pass the flash message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cliente/Create', [
            'crear' => $this->crear,
            'editar' => $this->editar,
            'flash' => [
                'error' => session('error'),
                'success' => session('success')
            ],// Pass the flash message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $persona = Persona::create([
            'nombre' => $request->input('persona.nombre'),
            'direccion' => $request->input('persona.direccion'),
            'telefono' => $request->input('persona.telefono'),
            'correo' => $request->input('persona.correo'),
        ]);

        $cliente = $persona->cliente()->create([
            'nit' => $request->input('cliente.nit'),
            'razon_social' => $request->input('cliente.razon_social'),
        ]);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $cliente->load('persona');


        return Inertia::render('Cliente/Editar', [
            'model' => $cliente,
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            'flash' => [
                'error' => session('error'),
                'success' => session('success')
            ],// Pass the flash message
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $persona = $cliente->persona;
        $persona->update([
            'nombre' => $request->input('persona.nombre'),
            'direccion' => $request->input('persona.direccion'),
            'telefono' => $request->input('persona.telefono'),
            'correo' => $request->input('persona.correo'),
        ]);
        $cliente->update([
            'nit' => $request->input('cliente.nit'),
            'razon_social' => $request->input('cliente.razon_social'),
        ]);
        return redirect()->route('clientes.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->persona()->delete();
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
