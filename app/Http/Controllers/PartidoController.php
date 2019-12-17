<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Partido;
use App\Grupo;
use App\Fixture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id=Crypt::decrypt($id);
        $act=Actividad::find($id);
        return view('partido.index')->with('actividad',$act);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function partidos_arbitro($id){
      $id=Crypt::decrypt($id);
      $partidos=DB::table('partidos')->where('arbitro_id',$id)->get();
      return view('partido.partidos_arbitro')->with('partidos',$partidos);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=Crypt::decrypt($id);
        $partido=Partido::find($id);
        return view('partido.edit')->with('partido',$partido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request)
    {
        $id=Crypt::decrypt($request['id']);
        $reglas=array(
          'hora_partido'=>'required|string|min:5|max:5'
        );
        $this->validate($request,$reglas);
        $partido=Partido::find($id);
        $partido->hora_partido=$request['hora_partido'];
        $partido->arbitro_id=$request['arbitro_id'];
        $partido->save();
        $act_id=$partido->actividad()->get()->last()->id;
        return redirect('/partido/'.Crypt::encrypt($act_id))->with('estado','El partido fue actualizado exitosamente');
    }
    public function resultados($id){
      $id=Crypt::decrypt($id);
      $partido=Partido::find($id);
      return view('partido.resultados')->with('partido',$partido);
    }

    public function guardar_resultado(Request $request){
      $id=Crypt::decrypt($request['id']);
      $partido=Partido::find($id);
      $ArbIdPart=$partido->arbitro_id;
      $partido->goles_local=$request['goles_local'];
      $partido->goles_visitante=$request['goles_visitante'];
      $partido->estado=1;
      $partido->save();
      if($partido->actividad()->get()->last()->grupo()->get()->last()->tipo==0){
        $fix_id=$partido->actividad()->get()->last()->grupo()->get()->last()->fixture()->get()->last()->id;
        $GrupoIds=DB::table('grupos')->where('grupos.fixture_id',$fix_id)->where('grupos.tipo',0)->select('id')->get();
        $ArrayGrupoIds=array();
        foreach($GrupoIds as $GrupoId){
          $ArrayGrupoIds[]=$GrupoId->id;
        }
        $ActividadIds=DB::table('actividades')->whereIn('actividades.grupo_id',$ArrayGrupoIds)->select('id')->get();
        $ArrayActIds=array();
        foreach($ActividadIds as $ActividadId){
          $ArrayActIds[]=$ActividadId->id;
        }
        $partidosJugados=DB::table('partidos')->whereIn('partidos.actividad_id',$ArrayActIds)->where('partidos.estado',1)->get();
        $partidosTotales=DB::table('partidos')->whereIn('partidos.actividad_id',$ArrayActIds)->get();
        $partidosFaltantes=count($partidosTotales)-count($partidosJugados);
        if($partidosFaltantes==0){
          $p=new Partido;//por completar
          $ganadoresSeries=(new Grupo)->ganadoresSerie(Fixture::find($fix_id));
          $horas=array();
          $arbitros=array();
          foreach ($partidosTotales as $partido) {
            $horas[$partido->hora_partido]=$partido->hora_partido;
            $arbitros[$partido->arbitro_id]=$partido->arbitro_id;
          }
          $horas=array_values($horas);
          $arbitros=array_values($arbitros);
          $clasifs=Fixture::find($fix_id)->grupos()->get()->last()->actividades()->get();


          $ganadoresSeriesC=array();
          $n=count($ganadoresSeries);
          for($i=0;$i<$n/2;$i++){
            $ganadoresSeriesC[]=$ganadoresSeries[$i][0];
            $ganadoresSeriesC[]=$ganadoresSeries[$n-1-$i][1];
            $ganadoresSeriesC[]=$ganadoresSeries[$i][1];
            $ganadoresSeriesC[]=$ganadoresSeries[$n-1-$i][0];
          }
          $cont=0;
          foreach ($clasifs as $activ) {
            if(strcmp($activ->nombre,"Octavos de Final - ida")==0){
                $p->crearOctavosIda($activ,$ganadoresSeries,$horas,$arbitros);
                $cont++;
            }
            if(strcmp($activ->nombre,"Octavos de Final - vuelta")==0){
                $p->crearOctavosVuelta($activ,$ganadoresSeries,$horas,$arbitros);
                $cont++;
            }
            if(strcmp($activ->nombre,"Cuartos de Final - ida")==0){
                $p->crearCuartosIda($activ,$ganadoresSeriesC,$horas,$arbitros);
                $cont++;
            }
            if(strcmp($activ->nombre,"Cuartos de Final - vuelta")==0){
                $p->crearCuartosVuelta($activ,$ganadoresSeriesC,$horas,$arbitros);
                $cont++;
            }
            if(strcmp($activ->nombre,"Semi Final - ida")==0){
                $p->crearSemifinalIda($activ,$ganadoresSeriesC,$horas,$arbitros);
                $cont++;
            }
            if(strcmp($activ->nombre,"Semi Final - vuelta")==0){
                $p->crearSemifinalVuelta($activ,$ganadoresSeriesC,$horas,$arbitros);
                $cont++;
            }
            if($cont==2)
              break;
          }
        }
      }
      else{
          //continuara: si todos los partidos fueron jugados en resultados ya dice ganador=0
          $fix_id=$partido->actividad()->get()->last()->grupo()->get()->last()->fixture()->get()->last()->id;
          $GrupoIds=DB::table('grupos')->where('grupos.fixture_id',$fix_id)->where('grupos.tipo',0)->select('id')->get();
          $ArrayGrupoIds=array();
          foreach($GrupoIds as $GrupoId){
            $ArrayGrupoIds[]=$GrupoId->id;
          }
          $ActividadIds=DB::table('actividades')->whereIn('actividades.grupo_id',$ArrayGrupoIds)->select('id')->get();
          $ArrayActIds=array();
          foreach($ActividadIds as $ActividadId){
            $ArrayActIds[]=$ActividadId->id;
          }
          $partidosJugados=DB::table('partidos')->whereIn('partidos.actividad_id',$ArrayActIds)->where('partidos.estado',1)->get();
          $partidosTotales=DB::table('partidos')->whereIn('partidos.actividad_id',$ArrayActIds)->get();
          switch(count($partido->actividad()->get()->last()->partidos()->get())){
            case 8:
                  $grupo=$partido->actividad()->get()->last()->grupo()->get()->last();
                  $resultClas=(new Actividad)->resultadosPorClasificatoria($grupo,"Octavos de Final");
                  $termino=true;
                  if(count($resultClas)<8)
                    $termino=false;
                  for($i=0;$i<count($resultClas);$i++){
                    if($resultClas[$i]['ganador']==0){
                      $termino=false;
                      break;
                    }
                  }
                  if($termino){
                    $acts=$grupo->actividades()->get();
                    $p=new Partido;
                    $ganadoresOctavos=(new Actividad)->GanadoresClasificatoria($resultClas);
                    $horas=array();
                    $arbitros=array();
                    foreach ($partidosTotales as $partido) {
                      $horas[$partido->hora_partido]=$partido->hora_partido;
                      $arbitros[$partido->arbitro_id]=$partido->arbitro_id;
                    }
                    $horas=array_values($horas);
                    $arbitros=array_values($arbitros);
                    foreach ($acts as $activ) {
                      if(strcmp($activ->nombre,"Cuartos de Final - ida")==0){
                          $p->crearCuartosIda($activ,$ganadoresOctavos,$horas,$arbitros);
                      }
                      if(strcmp($activ->nombre,"Cuartos de Final - vuelta")==0){
                          $p->crearCuartosVuelta($activ,$ganadoresSeriesC,$horas,$arbitros);
                      }
                    }
                    //Crear Cuartos de final

                  }

                  break;
            case 4:
                  $grupo=$partido->actividad()->get()->last()->grupo()->get()->last();
                  $resultClas=(new Actividad)->resultadosPorClasificatoria($grupo,"Cuartos de Final");
                  $termino=true;
                  if(count($resultClas)<4)
                    $termino=false;
                  for($i=0;$i<count($resultClas);$i++){
                    if($resultClas[$i]['ganador']==0){
                      $termino=false;
                      break;
                    }
                  }
                  if($termino){
                    $acts=$grupo->actividades()->get();
                    $p=new Partido;
                    $ganadoresCuartos=(new Actividad)->GanadoresClasificatoria($resultClas);
                    $horas=array();
                    $arbitros=array();
                    foreach ($partidosTotales as $partido) {
                      $horas[$partido->hora_partido]=$partido->hora_partido;
                      $arbitros[$partido->arbitro_id]=$partido->arbitro_id;
                    }
                    $horas=array_values($horas);
                    $arbitros=array_values($arbitros);
                    foreach ($acts as $activ) {
                      if(strcmp($activ->nombre,"Semi Final - ida")==0){
                          $p->crearSemifinalIda($activ,$ganadoresCuartos,$horas,$arbitros);
                      }
                      if(strcmp($activ->nombre,"Semi Final - vuelta")==0){
                          $p->crearSemifinalVuelta($activ,$ganadoresCuartos,$horas,$arbitros);
                      }
                    }

                  }
                  break;
            case 2:
                  $grupo=$partido->actividad()->get()->last()->grupo()->get()->last();
                  $resultClas=(new Actividad)->resultadosPorClasificatoria($grupo,"Semi Final");
                  $termino=true;
                  if(count($resultClas)<2)
                    $termino=false;
                  for($i=0;$i<count($resultClas);$i++){
                    if($resultClas[$i]['ganador']==0){
                      $termino=false;
                      break;
                    }
                  }
                  if($termino){
                    $acts=$grupo->actividades()->get();
                    $p=new Partido;
                    $ganadoresSemiFinal=(new Actividad)->GanadoresClasificatoria($resultClas);
                    $horas=array();
                    $arbitros=array();
                    foreach ($partidosTotales as $partido) {
                      $horas[$partido->hora_partido]=$partido->hora_partido;
                      $arbitros[$partido->arbitro_id]=$partido->arbitro_id;
                    }
                    $horas=array_values($horas);
                    $arbitros=array_values($arbitros);
                    foreach ($acts as $activ) {
                      if(strcmp($activ->nombre,"Final")==0){
                          $p->crearFinal($activ,$ganadoresSemiFinal,$horas,$arbitros);
                      }
                    }

                  }
                  break;
            case 1:
                  $fix=$partido->actividad()->get()->last()->grupo()->get()->last()->fixture()->get()->last();
                  $fix->estado=1;
                  $fix->save();
                  //cambiar estado del fixture;
                  break;
          }

      }
      return redirect('/partido/partidos_arbitro/'.Crypt::encrypt($ArbIdPart))->with('estado','Resultados del partido guardado correctamente!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=Crypt::decrypt($request['id']);
        $act=Partido::find($id)->actividad()->get()->last();
        Partido::destroy($id);
        return redirect('/partido/'.Crypt::encrypt($act->id))->with('estado','Partido borrado exitosamente!!!');
    }
}
