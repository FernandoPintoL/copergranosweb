<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    /** @use HasFactory<\Database\Factories\SeguimientoFactory> */
    use HasFactory;
    protected $table = 'seguimiento';
    protected $fillable = [
        'envio_id',
        'descripcion',
        'estado_actual',
        'ubicacion_actual'
    ];
    // envio_id
    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }
}
