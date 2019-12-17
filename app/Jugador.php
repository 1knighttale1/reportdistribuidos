<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipo;
use App\Persona;
class Jugador extends Model
{
    protected $table='jugadores';
    public function equipo(){
      return $this->belongsTo(Equipo::class);
    }
    public function persona(){
      return belongsTo(Persona::class);
    }
}
