<?php

// app/Models/Rating.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    // Si la tabla tiene nombres en plural, puedes especificar el nombre de la tabla aquí (aunque no es necesario si Laravel lo puede inferir)
    protected $table = 'ratings';

    // Campos que pueden ser asignados masivamente
    protected $fillable = ['proveedor_id', 'user_id', 'rating', 'review'];

    // Relación inversa: un rating pertenece a un proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
