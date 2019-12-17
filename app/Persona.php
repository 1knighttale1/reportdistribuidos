<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Administrador;
use App\Delegado;
use App\Arbitro;
use App\Jugador;

class Persona extends Model
{
   protected $table = 'personas';

   public function administrador (){
    	return $this->hasOne(Administrador::class);
    }

    public function delegado (){
    	return $this->hasOne(Delegado::class);
    }

    public function arbitro(){
    	return $this->hasOne(Arbitro::class);
    }

    public function jugador(){
    	return $this->hasOne(Jugador::class);
    }

}
