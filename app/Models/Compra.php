<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;
    protected $table = 'compra';
    protected $fillable = [
        'cliente_id',
        'administrativo_id',
        'pago_id',
        'precio_total',
        'estado'
    ];
    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'persona_id');
    }
    public function administrativo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id', 'persona_id');
    }
    public function pago(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pago::class, 'pago_id', 'id');
    }
}
