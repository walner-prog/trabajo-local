<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Solicitud extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'solicitudes';

    protected $fillable = ['client_id', 'service_id', 'status', 'scheduled_date', 'notes', 'price', 'disponibilidad'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
