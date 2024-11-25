<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    /** @use HasFactory<\Database\Factories\MetodoPagoFactory> */
    use HasFactory;
    protected $table = 'metodo_pagos';
    protected $fillable = [
        'sigla',
        'detalle'
    ];

}
