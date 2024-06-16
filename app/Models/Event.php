<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start',
        'end',
        'color',
        'user_id', // Añadir user_id al fillable
    ];

    /**
     * Obtener el usuario que creó el evento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
