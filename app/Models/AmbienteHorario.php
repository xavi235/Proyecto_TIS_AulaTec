<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbienteHorario extends Model
{
    protected $fillable = ['estado', 'id_ambiente', 'id_horario', 'dia'];

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'id_ambiente');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
}
