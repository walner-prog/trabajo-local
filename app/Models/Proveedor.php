<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Proveedor extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = 'proveedores';

    protected $fillable = ['user_id', 'specialty','city', 'experience_years','phone', 'bio', 'location', 'verified',
                            'certifications','education','languages','average_rating','reviews_count',];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function likes()
    {
        return $this->hasMany(ProviderLike::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class); // Asegúrate de que Rating es el nombre correcto del modelo de calificaciones
    }

    public function awards()
   {
    return $this->hasMany(Award::class);
   }

  
}
