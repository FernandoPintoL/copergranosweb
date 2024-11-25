<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    /** @use HasFactory<\Database\Factories\AdministrativoFactory> */
    use HasFactory;
    protected $table = 'administrativos';
    protected $primaryKey = 'persona_id';
    protected $fillable = [
        'ci',
        'departamento',
        'puesto',
        'salario',
        'user_id'
    ];
    public function persona(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
