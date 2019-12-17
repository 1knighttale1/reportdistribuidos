<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Persona;
use App\Partido;

class Arbitro extends Model
{
    protected $table = 'arbitros';

    public function persona (){
    	return $this->belongsTo(Persona::class);
    }
    public function partidos(){
      return $this->hasMany(Partido::class);
    }
}
