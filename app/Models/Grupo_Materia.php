<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_Materia extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }
    
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
    
    public function usuario_materia()
    {
        return $this->belongsTo(Usuario_Materia::class, 'id_usuario_materia');
    }
}
