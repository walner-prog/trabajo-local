<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Award extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'proveedor_id', 
        'award_name', 
        'awarding_institution', 
        'year', 
        'description'
    ];
    

    // Relación con el modelo Doctor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
