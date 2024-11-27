<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
