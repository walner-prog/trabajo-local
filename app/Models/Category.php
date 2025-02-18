<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description',  'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
