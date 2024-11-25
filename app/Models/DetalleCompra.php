<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    /** @use HasFactory<\Database\Factories\DetalleCompraFactory> */
    use HasFactory;
    protected $table = 'detalle_compra';
    public $timestamps = false;
    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];
    public function compra(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Compra::class, 'compra_id', 'id');
    }
    public function producto(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

}
