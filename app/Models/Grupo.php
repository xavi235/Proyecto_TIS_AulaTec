<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'grupo'
    ];
    public function materia(){
        return $this->hasMany(Materia::class, 'id_materia');
    }
}
