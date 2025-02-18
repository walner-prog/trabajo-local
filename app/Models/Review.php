<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'client_id',
        'rating',
        'comment',
    ];

    /**
     * Relación: Una reseña pertenece a un servicio.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relación: Una reseña pertenece a un cliente.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
