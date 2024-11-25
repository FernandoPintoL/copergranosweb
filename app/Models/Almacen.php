<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    /** @use HasFactory<\Database\Factories\AlmacenFactory> */
    use HasFactory;
    protected $table = 'almacenes';
    protected $fillable = [
        'sigla',
        'detalle'
    ];
    public function productos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Producto::class, 'almacen_id', 'id');
    }
}
