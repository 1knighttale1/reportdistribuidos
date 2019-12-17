<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Arbitro;
use App\Equipo;
use App\Actividad;

class Partido extends Model
{
    //
    protected $table='partidos';
    public function arbitro(){
      return $this->belongsTo(Arbitro::class);
    }
    public function equipos(){
      return $this->belongsToMany(Equipo::class);
    }
    public function actividad(){
      return $this->belongsTo(Actividad::class);
    }
    public function valorEquipo($equipo){
      $val=0;
      $difG=$equipo['GF']-$equipo['GC'];
      $val+=100000*$equipo['puntos'];//100000
      $val+=100*$difG;               //100
      $val+=1*$equipo['GF'];         //1 
      return $val;
    }

    public function crearPartidos($act,$cantPartidosDia,$horas,$partidos,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      foreach($partidos as $partido){
        if(($partido['local']!=-1)&&($partido['visitante']!=-1)){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$partido['local'];
          $par->visitante_id=$partido['visitante'];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
        }
      }
    }
    public function crearOctavosIda($act,$ganadoresSerie,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<4;$i++){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadoresSerie[$i][0];
          $par->visitante_id=$ganadoresSerie[7-$i][1];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;

          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadoresSerie[$i][1];
          $par->visitante_id=$ganadoresSerie[7-$i][0];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearOctavosVuelta($act,$ganadoresSerie,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<4;$i++){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadoresSerie[7-$i][1];
          $par->visitante_id=$ganadoresSerie[$i][0];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;

          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadoresSerie[7-$i][0];
          $par->visitante_id=$ganadoresSerie[$i][1];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearCuartosIda($act,$ganadores,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<8;$i+=2){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadores[$i];
          $par->visitante_id=$ganadores[$i+1];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearCuartosVuelta($act,$ganadores,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<8;$i+=2){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadores[$i+1];
          $par->visitante_id=$ganadores[$i];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearSemifinalIda($act,$ganadores,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<4;$i+=2){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadores[$i];
          $par->visitante_id=$ganadores[$i+1];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearSemifinalVuelta($act,$ganadores,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
      $ph=0;
      $pa=0;
      for($i=0;$i<4;$i+=2){
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[$ph++];
          $par->estado=0;
          $par->arbitro_id=$arbitros[$pa++];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadores[$i+1];
          $par->visitante_id=$ganadores[$i];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();

          $FI+=(intval(($ph/count($horas)))*86400);
          $ph=$ph%count($horas);
          $pa=($pa==count($arbitros))?0:$pa;
      }
    }
    public function crearFinal($act,$ganadores,$horas,$arbitros){
      $FI=strtotime($act->fecha_inicio);
          $par=new Partido;
          $par->fecha_partido=date("Y-m-d", $FI);
          $par->hora_partido=$horas[0];
          $par->estado=0;
          $par->arbitro_id=$arbitros[0];
          $par->actividad_id=$act->id;
          $par->local_id=$ganadores[0];
          $par->visitante_id=$ganadores[1];
          $par->goles_local=0;
          $par->goles_visitante=0;
          $par->save();
    }
}
