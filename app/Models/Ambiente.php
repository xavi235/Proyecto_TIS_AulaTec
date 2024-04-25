<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['departamento', 'capacidad', 'tipoDeAmbiente','id_ubicacion'];

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class , 'id_ubicacion');
    }
    public function dia(){
        return $this->hasMany(dia::class , 'id_dia');
    }
    public function estado(){
        return $this->hasOne(Estado::class , 'id_estado');
    }
}
