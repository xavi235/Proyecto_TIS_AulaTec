<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'nombre',
    ];

    public function grupo(){
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function usuario_materia(){
        return $this->belongsTo(Usuario_Materia::class, 'id_usuario_materia');
    }
}
