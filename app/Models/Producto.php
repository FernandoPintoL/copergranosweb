<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'medida_id',
        'proveedor_id'
    ];
    public function categoria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    public function medida(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Medida::class, 'medida_id', 'id');
    }
    public function inventario(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Inventario::class, 'producto_id', 'id');
    }
    public function detalleCompra(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'producto_id', 'id');
    }
    public function proveedor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id', 'id');
    }
}
