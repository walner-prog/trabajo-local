<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //

    protected $fillable = [
        'title',
        'autor',
        'rating',
        'fecha_creada',
    ];
}
