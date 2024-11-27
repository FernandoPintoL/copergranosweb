<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listado = User::all();
        $user = auth()->user();
        $crear = $user->canCrear('USER');
        $editar = $user->canEditar('USER');
        $eliminar = $user->canEliminar('USER');
        return Inertia::render("Users/Index", ['listado' => $listado, 'crear' => $crear, 'editar' => $editar, 'eliminar' => $eliminar]);
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
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $model_roles = $user->getRoleNames();
        $model_permissions = $user->getAllPermissions()->pluck('name');
        // dd($model_permissions);
        $user_adm = auth()->user();
        $crear = $user_adm->canCrear('USER');
        $editar = $user_adm->canEditar('USER');
        $eliminar = $user_adm->canEliminar('USER');
        return Inertia::render("Users/Edit", [
            'model' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'model_roles' => $model_roles,
            'model_permissions' => $model_permissions,
            'crear' => $crear,
            'editar' => $editar,
            'eliminar' => $eliminar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
