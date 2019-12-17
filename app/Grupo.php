<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actividad;
use App\Fixture;
use App\Partido;
class Grupo extends Model
{
    protected $table='grupos';
    public function actividades(){
      return $this->hasMany(Actividad::class);
    }
    public function fixture(){
        return $this->belongsTo(Fixture::class);
    }
    public function resultadosPorGrupo($grupo){
      $acts=$grupo->actividades()->get();
      $equipos=array();
      foreach ($acts as $act) {
        $partidos=$act->partidos()->get();
        foreach ($partidos as $partido) {
          //solucion

          $l=$partido->local_id;
          $v=$partido->visitante_id;
          $gl=$partido->goles_local;
          $gv=$partido->goles_visitante;
          $ganador=($gl>$gv)?1:(($gv>$gl)?2:3);
          if($partido->estado==0)
            $ganador=2;
          if(isset($equipos[$l])){
            $equipos[$l]['puntos']+=($ganador==1)? 3:(($ganador==2)? 0: 1);
            if($partido->estado==1)
              $equipos[$l]['PJ']++;
            $equipos[$l]['PG']+=($ganador==1)? 1:0;
            $equipos[$l]['PE']+=($ganador==3)? 1:0;
            if($partido->estado==0)
              $ganador=1;
            $equipos[$l]['PP']+=($ganador==2)? 1:0;
            $equipos[$l]['GF']+=$gl;
            $equipos[$l]['GC']+=$gv;
          }
          else{
            if($partido->estado==0)
              $ganador=2;
            $equipos[$l]['id']=$l;
            $equipos[$l]['puntos']=($ganador==1)? 3:(($ganador==2)? 0: 1);
            if($partido->estado==0)
              $equipos[$l]['PJ']=0;
            else
              $equipos[$l]['PJ']=1;
            $equipos[$l]['PG']=($ganador==1)? 1:0;
            $equipos[$l]['PE']=($ganador==3)? 1:0;
            if($partido->estado==0)
              $ganador=1;
            $equipos[$l]['PP']=($ganador==2)? 1:0;
            $equipos[$l]['GF']=$gl;
            $equipos[$l]['GC']=$gv;
          }
          if($partido->estado==0)
            $ganador=1;
          if(isset($equipos[$v])){
            $equipos[$v]['puntos']+=($ganador==2)? 3:(($ganador==1)? 0: 1);
            if($partido->estado==1)
            $equipos[$v]['PJ']++;
            $equipos[$v]['PG']+=($ganador==2)? 1:0;
            $equipos[$v]['PE']+=($ganador==3)? 1:0;
            if($partido->estado==0)
              $ganador=2;
            $equipos[$v]['PP']+=($ganador==1)? 1:0;
            $equipos[$v]['GF']+=$gv;
            $equipos[$v]['GC']+=$gl;
          }
          else{
            $equipos[$v]['id']=$v;
            $equipos[$v]['puntos']=($ganador==2)? 3:(($ganador==1)? 0: 1);
            if($partido->estado==1)
              $equipos[$v]['PJ']=1;
            else
              $equipos[$v]['PJ']=0;
            if($partido->estado==0)
              $ganador=1;
            $equipos[$v]['PG']=($ganador==2)? 1:0;
            $equipos[$v]['PE']=($ganador==3)? 1:0;
            if($partido->estado==0)
              $ganador=2;
            $equipos[$v]['PP']=($ganador==1)? 1:0;
            $equipos[$v]['GF']=$gv;
            $equipos[$v]['GC']=$gl;
          }
        }

      }
      //ordenar resultados
      $equipos=array_values($equipos);
      $tam=count($equipos);
      $part=new Partido;
      for($i=0;$i<$tam;$i++){
        for($j=0;$j<$tam-1;$j++){
          if($part->valorEquipo($equipos[$j])<$part->valorEquipo($equipos[$j+1])){
            $aux=$equipos[$j];
            $equipos[$j]=$equipos[$j+1];
            $equipos[$j+1]=$aux;
          }
        }
      }
      return $equipos;
    }
    public function ganadoresSerie($fix){
      $grupos=$fix->grupos()->get();
      $equiposGanadores=array();
      foreach ($grupos as $grupo) {
          if(strncmp($grupo->nombre, "Serie", 5)==0){
            $result=$grupo->resultadosPorGrupo($grupo);
            $equiposGanadores[]=array($result[0]['id'],$result[1]['id']);
          }
      }
      return $equiposGanadores;
    }
    public function CrearGrupos($fixture_id,$cant,$equipos,$cantPartidosDia,$horas,$fechaInicio,$arbts){
      $n=intval(count($equipos)/$cant);
      $res=(count($equipos))%$cant;
      $subEquipos;
      $na=intval(count($arbts)/$cant);
      $resa=(count($arbts))%$cant;
      $abitros;
      for($i=0;$i<$cant;$i++){
        $x=(0<$res--)?$n+1:$n;
        for($j=0;$j<$x;$j++){
          $pos=rand(0,count($equipos)-1);
          $subEquipos[$i][$j]=$equipos[$pos];
          unset($equipos[$pos]);
          $equipos = array_values($equipos);
        }
        $xa=(0<$resa--)?$na+1:$na;
        for($j=0;$j<$xa;$j++){
          $pos=rand(0,count($arbts)-1);
          $arbitros[$i][$j]=$arbts[$pos];
          unset($arbts[$pos]);
          $arbts = array_values($arbts);
        }
      }

      //crear series
          $s='A';
          for($i=0;$i<$cant;$i++){
            $serie=new Grupo;
            $serie->fixture_id=$fixture_id;
            $serie->tipo=0;
            $serie->nombre='Serie '.$s++;
            $serie->save();
            $act=new Actividad;
            $act->CrearActividades($serie->id,$subEquipos[$i],$cantPartidosDia,$horas,$fechaInicio,$arbitros[$i]);
          }
          if($cant>1){
            $serie=new Grupo;
            $serie->fixture_id=$fixture_id;
            $serie->tipo=1;
            $serie->nombre='Clasificatoria';
            $serie->save();
            $act=new Actividad;
            $act->CrearClasificatorias($serie->id,$cant,$cantPartidosDia,$fechaInicio);
          }
    }
}
