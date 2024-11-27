<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdministrativoRequest;
use App\Http\Requests\UpdateAdministrativoRequest;
use App\Models\Administrativo;
use App\Models\Categoria;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'listado' => Administrativo::with('persona')->get(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Gate::authorize('create', Categoria::class);
        return Inertia::render('Administrativos/Create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministrativoRequest $request)
    {
        $user = User::create([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
            'password' => bcrypt($request->input('user.password')),
        ]);

        // Fetch role IDs from the database
        $roleIds = Role::whereIn('name', $request->input('roles'))->pluck('id')->toArray();
        $user->roles()->sync($roleIds);

        // Fetch permission IDs from the database
        $permissionIds = Permission::whereIn('name', $request->input('permissions'))->pluck('id')->toArray();
        $user->permissions()->sync($permissionIds);

        $persona = Persona::create([
            'nombre' => $request->input('persona.nombre'),
            'direccion' => $request->input('persona.direccion'),
            'telefono' => $request->input('persona.telefono'),
            'correo' => $request->input('persona.correo'),
        ]);

        $administrativo = $persona->administrativo()->create([
            'ci' => $request->input('administrativo.ci'),
            'departamento' => $request->input('administrativo.departamento'),
            'puesto' => $request->input('administrativo.puesto'),
            'salario' => $request->input('administrativo.salario'),
        ]);
        return redirect()->route('administrativos.index')->with('success', 'Administrativo creado exitosamente.');
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
