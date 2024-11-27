<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdministrativoRequest;
use App\Http\Requests\UpdateAdministrativoRequest;
use App\Models\Administrativo;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AdministrativoController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('ADMINISTRATIVO');
        $this->editar = $this->user->canEditar('ADMINISTRATIVO');
        $this->eliminar = $this->user->canEliminar('ADMINISTRATIVO');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Administrativo::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('detalle', 'LIKE', "%{$query}%")
            ->get();
        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Gate::authorize('viewAny', Administrativo::class);
        return Inertia::render("Administrativos/Index", [
            'listado' => Administrativo::all(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar]);
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
    public function store(StoreAdministrativoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrativo $administrativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrativo $administrativo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministrativoRequest $request, Administrativo $administrativo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrativo $administrativo)
    {
        //
    }
}
