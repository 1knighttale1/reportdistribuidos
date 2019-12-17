<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultados</title>
  </head>
  <body>
    @extends ('layout')
    <br>
    <div class="container">
    <br/>
    <div class="panel panel-default">
		<div class="panel-body">
      <center><h1 class='display-4 text-primary text-center'>Resultados</h1></center>
        <div class="row">
        <?php
        use App\Equipo;
        $grupos=$fixture->grupos()->get();
        $cont=1;
        foreach ($grupos as $grupo): ?>
        <div class="col" align='center' >
        <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.8);
                            -moz-border-radius:20px;
                            border-radius: 20px;
                            -webkit-border-radius: 20px;
                            padding: 20px;

                            ">
        <legend class="w-auto"><h1 class='display-5 text-primary text-center'>{{$grupo->nombre}}</h1></legend>
          @if($grupo->tipo==0)
          <table class="table table-striped table-sm" >
              <thead>
                <tr align="center">
                  <td ><b>No.</b></td>
                  <td weight='30%'><b>Equipo</b></td>
                  <td ><b>Pts.</b></td>
                  <td ><b>PJ</b></td>
                  <td ><b>PG</b></td>
                  <td ><b>PE</b></td>
                  <td ><b>PP</b></td>
                  <td ><b>GF</b></td>
                  <td ><b>GC</b></td>
                  <td ><b>GD</b></td>
                </tr>
              </thead>
              <tbody>
                <?php
                $resultEquipos=$grupo->resultadosPorGrupo($grupo);
                $posicion=1;
                foreach ($resultEquipos as $resultEquipo): ?>

                  <tr align='center'>
                    <td>{{$posicion++}}</td>
                    <td align='left'>{{Equipo::find($resultEquipo['id'])->nombre_equipo}}</td>
                    <td>{{$resultEquipo['puntos']}}</td>
                    <td>{{$resultEquipo['PJ']}}</td>
                    <td>{{$resultEquipo['PG']}}</td>
                    <td>{{$resultEquipo['PE']}}</td>
                    <td>{{$resultEquipo['PP']}}</td>
                    <td>{{$resultEquipo['GF']}}</td>
                    <td>{{$resultEquipo['GC']}}</td>
                    <td>{{$resultEquipo['GF']-$resultEquipo['GC']}}</td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
        </table>
       @else
        <table class="table table-striped table-sm" >

             <tbody>
               <?php
               $resultEquipos=$grupo->resultadosPorGrupo($grupo);
               $matriz=array();
               for($i=0;$i<5;$i++){
                 switch ($i) {
                   case 0:
                     $result=$grupo->actividades()->get()->last()->resultadosPorClasificatoria($grupo,"Octavos de Final",true);
                     foreach ($result as $part) {
                       $matriz[0][]=$part;
                     }
                     break;
                   case 1:
                     $result=$grupo->actividades()->get()->last()->resultadosPorClasificatoria($grupo,"Cuartos de Final",true);
                     $pos=0;
                     foreach ($result as $part) {
                       $matriz[1][$pos++]=$part;
                     }
                       // code...
                     break;
                   case 2:
                     $result=$grupo->actividades()->get()->last()->resultadosPorClasificatoria($grupo,"Semi Final",true);
                     $pos=0;
                     foreach ($result as $part) {
                       $matriz[2][$pos++]=$part;
                     }
                       // code...
                     break;
                   case 3:
                     $result=$grupo->actividades()->get()->last()->resultadosPorClasificatoria($grupo,"Final",true);
                     $pos=0;
                     foreach ($result as $part) {
                       $matriz[3][$pos++]=$part;
                     }
                       // code...
                     break;
                   case 4:
                     $result=$grupo->actividades()->get()->last()->resultadosPorClasificatoria($grupo,"Final",true);
                     $ganador=$grupo->actividades()->get()->last()->GanadoresClasificatoria($result);
                     if(isset($ganador[0])){
                        $matriz[4][0]=$ganador[0];
                     }
                       // code...
                     break;
                 }
               }
               $cantCol=1;
               $title=array("Octvs.","Cuarts.","Semifinal","Final","Ganador");
               for ($i=0;$i<5;$i++):?>
                 <tr align='center'>
                   <th>{{$title[$i]}}</th>
                 <?php $cantc=(isset($matriz[$i]))?(count($matriz[$i])):0;

                 for($j=0;$j<8&&($j*$cantCol)<=8;$j++):
                 ?>
                    @if($i!=4)
                   <td colspan="{{$cantCol}}">
                     @if(isset($matriz[$i][$j]))
                     <?php $cantc--; ?>
                     {{Equipo::find($matriz[$i][$j]['local_id'])->nombre_equipo}}
                     <span align='right' class="badge badge-{{($matriz[$i][$j]['ganador']==1)?'success':'danger'}}">
                       {{$matriz[$i][$j]['GL']}}
                     </span>
                     <font color='orange'>{{" VS "}}</font>
                     <span align='right' class="badge badge-{{($matriz[$i][$j]['ganador']==2)?'success':'danger'}}">
                       {{$matriz[$i][$j]['GV']}}
                     </span>
                     {{Equipo::find($matriz[$i][$j]['visitante_id'])->nombre_equipo}}

                     @endif
                   </td>
                   @else
                   <td colspan="8">
                     @if(isset($matriz[4][0]))
                     {{Equipo::find($matriz[4][0])->nombre_equipo}}
                     @endif
                   </td>
                   @endif

               <?php

                endfor;?>
                </tr>
              <?php $cantCol*=2;
              endfor; ?>
             </tbody>
        </table>
       @endif
      </fieldset>
      </div>
      <?php if ($cont%2==0): ?>
      </div><div class="row">
      <?php endif; ?>
      <?php
      $cont++;
      endforeach; ?>
      </div>
  </div>
  </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
