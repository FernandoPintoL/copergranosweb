<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /** @use HasFactory<\Database\Factories\PersonaFactory> */
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'correo',
    ];

    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

}
