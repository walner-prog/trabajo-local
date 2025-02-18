<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['proveedor_id', 'category_id', 'title', 'description', 'price', 'availability','home_service','slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->slug = Str::slug($service->title);
        });
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function tags()
   {
    return $this->belongsToMany(Tag::class, 'service_tag');
   }

}
