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
        $this->crear = $this->user->canCrear('PERMISO');
        $this->editar = $this->user->canEditar('PERMISO');
        $this->eliminar = $this->user->canEliminar('PERMISO');
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
            'name' => $request->name
        ]);
        $model->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('flash.success', 'Creado exitosamente.');
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
        $role->load('permissions');
        return Inertia::render("Roles/Editar",
            [
                'model' => $role,
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
        return redirect()->route('roles.index')->with('flash.success', 'Creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->exists) {
            $role->delete();
            return redirect()->route('permissions.index')->with('flash.success', 'eliminado exitosamente.');
        }
        return redirect()->route('permissions.index')->with('flash.error', 'No se pudo eliminar el administrativo.');
    }
}
