<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    /** @use HasFactory<\Database\Factories\InventarioFactory> */
    use HasFactory;
    protected $table = 'inventario';
    //protected $primaryKey = 'id_persona';
    public $timestamps = false;
    protected $fillable = [
        'producto_id',
        'almacen_id',
        'stock',
        'fecha'
    ];
    public function producto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
    public function almacen(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Almacen::class, 'almacen_id', 'id');
    }
}
