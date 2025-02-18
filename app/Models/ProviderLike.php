<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id',
    ];

    /**
     * Relación con el usuario (quien da el "me gusta")
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el proveedor al que le dan el "me gusta"
     */
    public function provider()
    {
        return $this->belongsTo(Proveedor::class); // Asumiendo que tienes un modelo Provider
    }
}
