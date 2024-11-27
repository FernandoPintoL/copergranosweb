<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Administrativo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('CATEGORIA');
        $this->editar = $this->user->canEditar('CATEGORIA');
        $this->eliminar = $this->user->canEliminar('CATEGORIA');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Categoria::where('sigla', 'LIKE', "%{$query}%")
                ->orWhere('detalle', 'LIKE', "%{$query}%")
                ->get();
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Gate::authorize('viewAny', Categoria::class);
        return Inertia::render('Categorias/Index', [
            'listado' => Categoria::all(),
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            'flash' => session('error') // Pass the flash message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Gate::authorize('create', Categoria::class);
        return Inertia::render('Categorias/Create', [
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            'flash' => session('error') // Pass the flash message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('flash.success', 'Administrativo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //Gate::authorize('update', $categoria);
        return Inertia::render('Categorias/Editar', ['model' => $categoria,
            'crear' => $this->crear,
            'editar' => $this->editar,
            'eliminar' => $this->eliminar,
            'flash' => session('error') // Pass the flash message
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {

        //$request->validate(['nombre' => 'required']);
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('flash.success', 'Administrativo creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //Gate::authorize('delete', $categoria);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('flash.success', 'Administrativo creado exitosamente.');
    }
}
