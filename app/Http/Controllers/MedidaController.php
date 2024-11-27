<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedidaRequest;
use App\Http\Requests\UpdateMedidaRequest;
use App\Models\Medida;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedidaController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('MEDIDA');
        $this->editar = $this->user->canEditar('MEDIDA');
        $this->eliminar = $this->user->canEliminar('MEDIDA');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Medida::where('sigla', 'LIKE', "%{$query}%")
                ->orWhere('detalle', 'LIKE', "%{$query}%")
                ->get();
    }
    public function index()
    {
        return Inertia::render('Medidas/Index', [
            'listado' => Medida::all(),
            'crear'=>$this->crear,
            'editar'=>$this->editar,
            'eliminar'=>$this->eliminar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Medidas/Create', [
            'crear'=>$this->crear,
            'editar'=>$this->editar,
            'eliminar'=>$this->eliminar
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedidaRequest $request)
    {
        Medida::create($request->all());
        return redirect()->route('medidas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medida $medida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medida $medida)
    {
        return Inertia::render('Medidas/Editar', ['model'=> $medida,
            'crear'=>$this->crear,
            'editar'=>$this->editar,
            'eliminar'=>$this->eliminar,
            'flash' => session('error') // Pass the flash message
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedidaRequest $request, Medida $medida)
    {
        $medida->update($request->all());
        return redirect()->route('medidas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medida $medida)
    {
        $medida->delete();
        return redirect()->route('medidas.index');
    }
}
