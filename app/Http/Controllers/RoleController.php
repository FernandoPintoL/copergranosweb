<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('ROLE');
        $this->editar = $this->user->canEditar('ROLE');
        $this->eliminar = $this->user->canEliminar('ROLE');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Role::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listado = Role::all();
        return Inertia::render("Roles/Index", [
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
        return Inertia::render("Roles/Create", [
            'permissions' => Permission::all(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // crear el rol y vincular con los permisos seleccionados
        $model = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        $model->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Transaccion exitosa.');
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
    public function edit(Role $role)
    {
        //roles con permisos asignados
        $role->permissions = $role->permissions->pluck('name');
        return Inertia::render("Roles/Editar",
            [
                'model' => $role,
                'permissions' => Permission::all(),
                'model_permissions' => $role->permissions,
                'crear' => $this->crear,
                'editar' => $this->editar,
                'eliminar' => $this->eliminar
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return redirect()->route('roles.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Roles $role)
    {
        if ($role->exists) {
            $role->delete();
            return redirect()->route('permissions.index')->with('success', 'Transaccion exitosa.');
        }
        return redirect()->route('permissions.index')->with('error', 'No se pudo eliminar.');
    }
}
