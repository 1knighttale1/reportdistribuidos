<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;
use App\Administrador;

class Fixture extends Model
{
    protected $table = 'fixtures';

    public function grupos(){
    	return $this -> hasMany(Grupo::class);

    }
    public function administrador (){
    	return $this -> belongsTo(Administrador::class);
    }
}
