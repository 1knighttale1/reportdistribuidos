<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Persona;
use App\Fixture;
class Administrador extends Model
{
    protected $table = 'administradores';

    public function persona (){
    	return $this->belongsTo(Persona::class);
    }
    public function fixtures(){
      return $this->hasMany(Fixture::class);
    }
}
