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
    ];
    public function ambiente_horario(){
        return $this->hasMany(AmbienteHorario::class, 'id_horario');
    }
    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'id_ambiente');
    }
    /**public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'id_ambiente');
    }_*/
}


