<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    /** @use HasFactory<\Database\Factories\EnvioFactory> */
    use HasFactory;
    protected $table = 'envio';
    protected $fillable = [
        'direccion_destino',
        'ciudad_destino',
        'pais_destino',
        'fecha_entrega',
        'descripcion_entrega',
        'estado_envio',
        'metodo_envio_id',
        'compra_id',
    ];
    public function compra(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Compra::class, 'compra_id', 'id');
    }
    public function metodoenvio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MetodoEnvio::class, 'metodo_envio_id', 'id');
    }
}
