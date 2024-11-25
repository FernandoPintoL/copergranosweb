<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /** @use HasFactory<\Database\Factories\PagoFactory> */
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = [
        'monto',
        'moneda',
        'fecha_pago',
        'estado_pago',
        'metodo_pagos_id'
    ];
    public function metodopago(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pagos_id', 'id');
    }
}
