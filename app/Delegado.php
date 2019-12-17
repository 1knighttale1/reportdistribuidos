<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Persona;
use App\Equipo;

class Delegado extends Model
{
    protected $table = 'delegados';

    public function persona(){
    	return $this-> belongsTo(Persona::class);
    }

    public function equipo(){
    	return $this ->hasOne(Equipo::class);
    }
}
