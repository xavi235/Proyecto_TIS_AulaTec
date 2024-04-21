<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
     protected $fillable = ['departamento', 'capacidad', 'tipoDeAmbiente','id_ubicacion'];

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class , 'id_ubicacion');
    }
}
