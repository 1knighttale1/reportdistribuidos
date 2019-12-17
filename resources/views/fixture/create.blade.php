
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Fixture</title>
  </head>
  <body style="background: url(../img/backgrounds/pelota.jpg);
  font-family: 'PT Sans', Helvetica, Arial, sans-serif;
  text-align: center;
  color: #fff;
  background-repeat: no-repeat:;
  background-size: 100%;">

    <script language="JavaScript" type="text/JavaScript">
      function suma(obj)
      {
          total=document.getElementById("numEquipos").value;
          if(obj.checked) total++;
          else total--;
          txttotal=total+"";
          if (txttotal=="0"){ txttotal="0";}
          document.getElementById("numEquipos").value=txttotal;
      }
      function sumah(obj)
      {
          total=document.getElementById("cantPD").value;
          if(obj.checked) total++;
          else total--;
          txttotal=total+"";
          if (txttotal=="0"){ txttotal="0";}
          document.getElementById("cantPD").value=txttotal;
      }
      function sumaAr(obj)
      {
          total=document.getElementById("numArbitros").value;
          if(obj.checked) total++;
          else total--;
          txttotal=total+"";
          if (txttotal=="0"){ txttotal="0";}
          document.getElementById("numArbitros").value=txttotal;
      }
    </script>
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">

    {{Form::open(array('method'=>'POST','route'=>'fixture.guardar','class'=>'needs-validation','novalidate'))}}

      <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.8);
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Nuevo Fixture</p></legend>

      <div class="panel panel-default">
			<div class="panel-body">
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
      <div class="form-row">
        <div class="col-md-4 mb-3">
          {{Form::label('nombre','Nombre de Fixture')}}
          {{Form::text('nombre','',[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"nombre",
            'placeholder'=>"Nombre Fixture",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('nombre'))? 'in':''}}valid-feedback">
            {{$errors->has('nombre')?$errors->first('nombre'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>

        <div class="col-md-4 mb-3">
          {{Form::label('series','Numero de Series')}}
          {{Form::number('series','1',[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('series'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"series",
            'placeholder'=>"num. series"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('series'))? 'in':''}}valid-feedback">
            {{$errors->has('series')?$errors->first('series'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3 ">
          <?php $es=App\Equipo::all(); ?>
          <center><h4 class='center'>
            <span class="badge badge-secondary ">Equipos</span>
            <span class="badge badge-danger " >
              {{Form::text('numEquipo',count($es),['id'=>'numEquipos','size'=>'1','style'=>'border:none; background:inherit; font-weight: bold; color: white;','readonly'])}}
            </span>
          </h4></center>

          <div class='table-responsive was-validated' style='height: 240px;'>
          <table class="table table-striped table-sm" >
            <tbody>

              @foreach($es as $e)
              <tr>
                <td>
                  <div class="custom-control custom-checkbox mb-3">
                    {{Form::checkbox('equipos[]', $e->id , true,['id'=>'equipo'.$e->id,'class'=>'custom-control-input','onChange'=>'suma(this)','required'])}}
                    <label class="custom-control-label" style='font-weight: bold;' for="equipo{{$e->id}}">{{$e->nombre_equipo}}</label>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
          @if(($errors->has('numEquipo')))
          <div class=" {{($errors->has('numEquipo'))? 'alert alert-danger':''}}" role="alert">
            {{$errors->first('numEquipo')}}
          </div>
          @endif
        </div>

        <div class="col-md-4 mb-3">
          <center><h4 class='center'>
            <span class="badge badge-secondary ">Partidos Por Dia</span>
            <span class="badge badge-danger " >
              {{Form::text('cantPD','0',['id'=>'cantPD','size'=>'1','style'=>'border:none; background:inherit; font-weight: bold; color: white;','readonly'])}}
            </span>
          </h4></center>
          <table class="table table-striped table-sm table-responsive">
            <tbody>
              <?php $hs=array('0'=>'08:00','1'=>'10:00','2'=>'14:00','3'=>'16:00','4'=>'18:00');  ?>
              @for($i=0;$i<count($hs);$i++)
              <tr> <td> <div class="custom-control custom-checkbox mb-3">
                    {{Form::checkbox('horas[]', $hs[$i] , false,['id'=>'hora'.$i ,'class'=>'custom-control-input','onChange'=>'sumah(this)'])}}
                    <label class="custom-control-label" style='font-weight: bold;' for='hora{{$i}}'>{{$hs[$i]}}</label>
              </div> </td> </tr>
              @endfor
            </tbody>
          </table>
          @if(($errors->has('cantPD')))
          <div class=" {{($errors->has('cantPD'))? 'alert alert-danger':''}}" role="alert">
            {{$errors->first('cantPD')}}
          </div>
          @endif
        </div>

        <div class="col-md-4 mb-3 ">
          <div class="form-group">
            <?php
            $listArb=array();
            $arbitros=App\Arbitro::all();
            foreach ($arbitros as $arbitro){
              $per=$arbitro->persona()->get()->last();
              $listArb[$arbitro->id]=''.$per->nombre.' '.$per->ap_paterno;
            }
            ?>
            <center><h4 class='center'>
              <span class="badge badge-secondary ">Arbitros</span>
              <span class="badge badge-danger " >
                {{Form::text('numArbitros','0',['id'=>'numArbitros','size'=>'1','style'=>'border:none; background:inherit; font-weight: bold; color: white;','readonly'])}}
              </span>
            </h4></center>
            <div class='table-responsive' style='height: 200px;'>
            <table class="table table-striped table-sm" >
              <tbody>

                @foreach($listArb as $id_ar=>$nom_ar)
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox mb-3">
                      {{Form::checkbox('arbitros[]', $id_ar , false,['id'=>'arbitro'.$id_ar,'class'=>'custom-control-input','onChange'=>'sumaAr(this)','required'])}}
                      <label class="custom-control-label" style='font-weight: bold;' for="arbitro{{$id_ar}}">{{$nom_ar}}</label>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @if(($errors->has('numArbitros')))
            <div class=" {{($errors->has('numArbitros'))? 'alert alert-danger':''}}" role="alert">
              {{$errors->first('numArbitros')}}
            </div>
            @endif
          </div>
          <div class="form-group">
            <h4 class='center'>
              <span class="badge badge-secondary ">Fecha de Inicio</span>
            </h4>
            {{Form::date('fecha_inicio',Date('Y-m-d'),['required'])}}
          </div>
        </div>
      </div>
      </div>
      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger"])}}
      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success"])}}
    </div>
      </div>
    </fieldset>

    {{Form::close()}}

    </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
