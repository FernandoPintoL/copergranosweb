<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Persona;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProveedorController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('PROVEEDOR');
        $this->editar = $this->user->canEditar('PROVEEDOR');
        $this->eliminar = $this->user->canEliminar('PROVEEDOR');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Proveedor::with('persona')->whereHas('persona', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%");
        })->orWhere('ci', 'LIKE', "%{$query}%")->get();
        /*$result = Administrativo::with('persona')->where('ci', 'LIKE', "%{$query}%")
            ->get();*/
        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Proveedores/Index", [
            'listado' => Proveedor::with('persona')->get(),
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
        return Inertia::render('Proveedores/Create', [
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
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        $persona = Persona::create([
            'nombre' => $request->input('persona.nombre'),
            'direccion' => $request->input('persona.direccion'),
            'telefono' => $request->input('persona.telefono'),
            'correo' => $request->input('persona.correo'),
        ]);
        $proveedor = $persona->proveedor()->create([
            'nit' => $request->input('proveedor.nit'),
            'razon_social' => $request->input('proveedor.razon_social'),
        ]);
        return redirect()->route('proveedores.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedore)
    {
        $proveedore->load('persona');
        return Inertia::render('Proveedores/Editar', [
            'model' => $proveedore,
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
    public function update(UpdateProveedorRequest $request, Proveedor $proveedore)
    {
        // Update persona data
        $persona = $proveedore->persona;
        $persona->update([
            'nombre' => $request->input('persona.nombre'),
            'direccion' => $request->input('persona.direccion'),
            'telefono' => $request->input('persona.telefono'),
            'correo' => $request->input('persona.correo'),
        ]);

        // Update administrativo data
        $proveedore->update([
            'nit' => $request->input('proveedor.nit'),
            'razon_social' => $request->input('proveedor.razon_social'),
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedore)
    {
        // Debe eliminar la persona a la que es asociada
        $proveedore->persona()->delete();
        $proveedore->delete();
        return redirect()->route('proveedores.index')->with('success', 'Transaccion exitosa.');
    }
}
