<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\Proveedor;
use GuzzleHttp\Psr7\Request;
use Inertia\Inertia;

class ProductoController extends Controller
{
    protected $user;
    protected $crear;
    protected $editar;
    protected $eliminar;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->crear = $this->user->canCrear('PRODUCTO');
        $this->editar = $this->user->canEditar('PRODUCTO');
        $this->eliminar = $this->user->canEliminar('PRODUCTO');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Producto::where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('descripcion', 'LIKE', "%{$query}%")
                ->get();
    }
    public function index()
    {

        return Inertia::render('Productos/Index', [
            'listado' => Producto::all(),
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
        $medidas = Medida::all();
        $categoria = Categoria::all();
        $proveedor = Proveedor::with('persona')->get();
        return Inertia::render('Productos/Create', [
            'crear'=>$this->crear,
            'editar'=>$this->editar,
            'eliminar'=>$this->eliminar,
            'medidas'=>$medidas,
            'categoria'=>$categoria,
            'proveedor'=>$proveedor
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return Inertia::render('Productos/Editar', ['model'=> $producto,
            'crear'=>$this->crear,
            'editar'=>$this->editar,
            'eliminar'=>$this->eliminar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $request->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Transaccion exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
