<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function ambiente(){
        return $this->belongsTo(Ambiente::class , 'id_ambiente');
    }

}
