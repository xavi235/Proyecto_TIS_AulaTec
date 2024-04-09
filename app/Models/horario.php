<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'horaini',
        'horafin',
        'estado',
        'id_amhbiente',
    ];
    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'id_ambiente');
    }
}


