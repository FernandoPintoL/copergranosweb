<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'persona_id';
    protected $fillable = [
        'nit',
        'razon_social',
        'tipo_cliente',
    ];
    public function persona(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
}
