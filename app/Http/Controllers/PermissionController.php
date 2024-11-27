<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listado = Permission::all();
        $user = auth()->user();
        $crear = $user->canCrear('PERMISSION');
        $editar = $user->canEditar('PERMISSION');
        $eliminar = $user->canEliminar('PERMISSION');
        return Inertia::render("Permissions/Index", [
            'listado' => $listado,
            'crear' => $crear,
            'editar' => $editar,
            'eliminar' => $eliminar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $crear = $user->canCrear('PERMISSION');
        $editar = $user->canEditar('PERMISSION');
        return Inertia::render("Permissions/CreateUpdate", [
            'crear' => $crear,
            'editar' => $editar,
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
        return redirect()->route('permissions.index');
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
        $user = auth()->user();
        $crear = $user->canCrear('PERMISSION');
        $editar = $user->canEditar('PERMISSION');
        return Inertia::render("Permissions/CreateUpdate", ['model' => $permission, 'crear' => $crear, 'editar' => $editar]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
