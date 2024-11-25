<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoEnvio extends Model
{
    /** @use HasFactory<\Database\Factories\MetodoEnvioFactory> */
    //use HasFactory;
    protected $table = 'metodo_envio';
    protected $fillable = [
        'sigla',
        'detalle'
    ];

}
