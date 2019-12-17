<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grupo;
use App\Partido;

class Actividad extends Model
{
    //
    protected $table='actividades';
    public function grupo(){
      return $this->belongsTo(Grupo::class);
    }
    public function partidos(){
      return $this->hasMany(Partido::class);
    }
    public function resultadosPorClasificatoria($grupo,$type,$all = false){
      $act=$grupo->actividades()->get();
      $acts=array();
      foreach ($act as $ac) {
        if(strncmp ($ac->nombre, $type, strlen($type))==0){
          $acts[]=$ac;
        }
      }
      $equipos=array();
      foreach ($acts as $act) {
        $partidos=$act->partidos()->get();
        foreach ($partidos as $partido) {
          if($partido->estado==1||$all){
            $l=$partido->local_id;
            $v=$partido->visitante_id;
            $gl=$partido->goles_local;
            $gv=$partido->goles_visitante;
            $ganador=($gl>$gv)?1:2;
            if(isset($equipos[$v."".$l])){
              $equipos[$v."".$l]['GL']+=$gv;
              $equipos[$v."".$l]['GV']+=$gl;
              $equipos[$v."".$l]['ganador']=($equipos[$v."".$l]['GL']>$equipos[$v."".$l]['GV'])? 1 : 2 ;
            }
            else{
              $equipos[$l."".$v]['local_id']=$l;
              $equipos[$l."".$v]['visitante_id']=$v;
              $equipos[$l."".$v]['ganador']=($partido->estado==1)?$ganador:0;
              $equipos[$l."".$v]['GL']=$gl;
              $equipos[$l."".$v]['GV']=$gv;
            }
          }
        }
      }
      //ordenar resultados
      $equipos=array_values($equipos);

      return $equipos;
    }
    function GanadoresClasificatoria($resultClas){
      $ganadores=array();
      foreach ($resultClas as $enfrentamiento) {
        if($enfrentamiento['ganador']!=0){
          $ganadores[]=($enfrentamiento['ganador']==1)? $enfrentamiento['local_id']: $enfrentamiento['visitante_id'] ;
        }
      }
      return $ganadores;
    }
    public function crearActividades($grupo_id,$equipos,$cantPartidosDia,$horas,$fechaInicio,$arbitros){
      $n=count($equipos);
      if($n%2==1){
        $equipos[$n++]=-1;
      }
      $FI=strtotime($fechaInicio);
      $piv=0;
      $fn=1;
      do{
        $l=$piv;
        $r=$l-1;
        $r=($r<0)?(count($equipos))-1:$r;
        $ri=$r;
        $ld=$l;
        $partidos=array();


        for($i=0;$i<($n/2);$i++){
          $partidos[$i]=(round(0,1)==0)?array(
            'local'=> $equipos[$ld],
            'visitante'=> $equipos[$ri]
          ):array(
            'local'=> $equipos[$ri],
            'visitante'=> $equipos[$ld]
          );
          $ri--; $ld++;
          $ri=($ri<0)?(count($equipos))-1:$ri;
          $ld=$ld%count($equipos);
        }
        $duracion=intval(count($partidos)/$cantPartidosDia)+(((intval(count($partidos)%$cantPartidosDia))>0)?1:0);
        $duracion--;
        $act=new Actividad;
        $act->fecha_inicio=date("Y-m-d", $FI);
        $FI+=($duracion*86400);
        $act->fecha_fin=date("Y-m-d", $FI);
        $FI+=86400;
        $act->nombre='Fecha '.$fn++;
        $act->grupo_id=$grupo_id;
        $act->save();
        $part=new Partido;
        $part->crearPartidos($act,$cantPartidosDia,$horas,$partidos,$arbitros);

        $aux=$equipos[$r];
        $equipos[$r]=$equipos[$l];
        $equipos[$l]=$aux;

        $piv=$r;
      }while($piv!=1);
      $actPrimeraVuelta=Grupo::find($grupo_id)->actividades()->get();
      foreach($actPrimeraVuelta as $actividad){
        $parts=$actividad->partidos()->get();
        $duracion=intval(count($parts)/$cantPartidosDia)+(((intval(count($parts)%$cantPartidosDia))>0)?1:0);

        $act=new Actividad;
        $act->fecha_inicio=date("Y-m-d", $FI);
        $FI+=($duracion*86400);
        $act->fecha_fin=date("Y-m-d", $FI);
        $FI+=86400;
        $act->nombre='Fecha '.$fn++;
        $act->grupo_id=$grupo_id;
        $act->save();
        $partidos=array();
        foreach($parts as $part){
          $partidos[]=array(
            'local'=> $part->visitante_id,
            'visitante'=> $part->local_id
          );
        }
        $part=new Partido;
        $part->crearPartidos($act,$cantPartidosDia,$horas,$partidos,$arbitros);
      }
      return date("Y-m-d", $FI);
    }
    public function crearClasificatorias($grupo_id,$cant,$cantPartidosDia,$fechaInicio){
      $FI=strtotime($fechaInicio);
        switch($cant){
          case 8:
          $duracion=intval(8/$cantPartidosDia)+((8%$cantPartidosDia>0)?1:0);
          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Octavos de Final - ida';
          $act->grupo_id=$grupo_id;
          $act->save();

          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Octavos de Final - vuelta';
          $act->grupo_id=$grupo_id;
          $act->save();

          case 4:
          $duracion=intval(4/$cantPartidosDia)+((4%$cantPartidosDia>0)?1:0);
          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Cuartos de Final - ida';
          $act->grupo_id=$grupo_id;
          $act->save();

          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Cuartos de Final - vuelta';
          $act->grupo_id=$grupo_id;
          $act->save();

          case 2:
          $duracion=intval(2/$cantPartidosDia)+((2%$cantPartidosDia>0)?1:0);
          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Semi Final - ida';
          $act->grupo_id=$grupo_id;
          $act->save();

          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Semi Final - vuelta';
          $act->grupo_id=$grupo_id;
          $act->save();


          $duracion=intval(1/$cantPartidosDia)+((1%$cantPartidosDia>0)?1:0);
          $act=new Actividad;
          $act->fecha_inicio=date("Y-m-d", $FI);
          $FI+=($duracion*86400);
          $act->fecha_fin=date("Y-m-d", $FI);
          $FI+=86400;
          $act->nombre='Final';
          $act->grupo_id=$grupo_id;
          $act->save();
        }
    }
}
