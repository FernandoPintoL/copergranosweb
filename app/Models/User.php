<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relacion uno a uno con administrativo
    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

    //administrador
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    public function canIndex($modelo)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } else {
            $has_role = $this->hasAnyRole($modelo);
            $has_permissions = $this->hasAnyPermission([$modelo . '.LISTAR', $modelo . '.MOSTRAR']);
            return $has_permissions || $has_role;
        }
    }

    public function canCrear($modelo)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } else {
            $has_permissions = $this->hasPermissionTo($modelo . '.CREAR');
            return $has_permissions;
        }
    }

    public function canEditar($modelo)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } else {
            $has_permissions = $this->hasPermissionTo($modelo . '.EDITAR');
            return $has_permissions;
        }
    }

    public function canEliminar($modelo)
    {
        if ($this->isSuperAdmin()) {
            return true;
        } else {
            $has_permissions = $this->hasPermissionTo($modelo . '.ELIMINAR');
            return $has_permissions;
        }
    }

}
