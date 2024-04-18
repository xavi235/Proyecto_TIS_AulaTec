<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Materia extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany(User::class, 'id_user');
    }

    public function materia(){
        return $this->hasMany(Materia::class, 'id_materia');
    }
}
