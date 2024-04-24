<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoHorario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['estado' ];

    public function horario()
    {
        return $this->hasOne(Horario::class, 'id_horario');
    }
}
