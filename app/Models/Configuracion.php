<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['fecha_inicio','fecha_fin','periodos',];
}
