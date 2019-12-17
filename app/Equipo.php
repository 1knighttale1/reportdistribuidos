<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Jugador;
use App\Partido;
use App\Delegado;
class Equipo extends Model
{
    //
    protected $table='equipos';
    public function jugadores(){
      return $this->hasMany(Jugador::class);
    }
    
    public function delegado(){
      return $this->belongsTo(Delegado::class);
    }

}
