<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Relación: Un tag puede pertenecer a muchos servicios.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_tag');
    }
}
