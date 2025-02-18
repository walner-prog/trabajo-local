<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    // Definir los campos que son asignables en masa
    protected $fillable = [
        'user_id',
        'file_path',
        'title',
    ];

    /**
     * Relación con el modelo User (Doctor).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
