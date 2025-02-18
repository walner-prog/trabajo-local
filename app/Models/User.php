<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,  HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
      
        'google_id',
        'role',
        'avatar',
        'external_id',
        'external_auth',
        'registered',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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


    public function isProveedor()
    {
        return $this->proveedor !== null;
    }

    public function hasRole($role)
     { 
        return $this->role === $role;
     }

     public function proveedor()
     {
         return $this->hasOne(Proveedor::class);
     }

      /**
     * Relación: Un usuario (proveedor) puede tener varios servicios.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'proveedor_id');
    }

    /**
     * Relación: Un usuario (cliente) puede hacer muchas solicitudes.
     */
    public function requests()
    {
        return $this->hasMany(Solicitud::class, 'client_id');
    }

    /**
     * Relación: Un usuario (cliente) puede dejar muchas reseñas.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }
}
