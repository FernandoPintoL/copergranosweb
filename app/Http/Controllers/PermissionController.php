<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('PERMISO');
        $this->editar = $this->user->canEditar('PERMISO');
        $this->eliminar = $this->user->canEliminar('PERMISO');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Permission::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listado = Permission::all();
        return Inertia::render("Permissions/Index", [
            'listado' => $listado,
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            //'flash' => session('error') // Pass the flash message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Permissions/Create", [
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $model = Permission::create([
            'name' => $request->name
        ]);
        return redirect()->route('permissions.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //Gate::authorize('create', $permission);
        return Inertia::render("Permissions/Editar",
            [
                'model' => $permission,
                'crear' => $this->crear,
                'editar' => $this->editar,
                'eliminar' => $this->eliminar
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        return redirect()->route('permissions.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Permisos $permission)
    {
        ///return $permission;
        if ($permission->exists) {
            $permission->delete();
            return redirect()->route('permissions.index')->with('success', 'Transaccion exitosa.');
        }
        return redirect()->route('permissions.index')->with('error', 'No se pudo eliminar.');
    }
}
