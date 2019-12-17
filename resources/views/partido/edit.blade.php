<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Partido</title>
  </head>
  <body>
    @extends ('layout')
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">

    {{Form::open(array('method'=>'POST','route'=>'partido.actualizar','class'=>'needs-validation','novalidate'))}}

      <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Editar Partido</p></legend>

      <div class="panel panel-default">
			<div class="panel-body">
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
        <?php
        use Illuminate\Support\Facades\Crypt;
        use App\Equipo;
        ?>
          <input type='hidden' name='id' value='{{Crypt::encrypt($partido->id)}}'/>
      <div class="form-row">
            <div class="col-md-4 mb-3">
              {{Form::label('local','Equipo Local')}}
              {{Form::text('local',Equipo::find($partido->local_id)->nombre_equipo,[
                'class'=>'form-control '.( ($errors->isNotEmpty())?
                    (($errors->has('hora_partido'))? 'is-invalid' : 'is-valid'): '' ),
                'id'=>"local",'readonly'
                ]) }}
            </div>
            <div class="col-md-4 mb-3">
              {{Form::label('visitante','Equipo Visitante')}}
              {{Form::text('visitante',Equipo::find($partido->visitante_id)->nombre_equipo,[
                'class'=>'form-control '.( ($errors->isNotEmpty())?
                    (($errors->has('visitante'))? 'is-invalid' : 'is-valid'): '' ),
                'id'=>"visitante",'readonly'
                ]) }}

            </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          {{Form::label('fecha_partido','Fecha del Partido')}}
          {{Form::date('fecha_partido',$partido->fecha_partido,[
            'class'=>'form-control ',
            'id'=>"fecha_partido",'readonly']
            ) }}
        </div>
        <div class="col-md-4 mb-3">
          {{Form::label('hora_partido','Hora del Partido')}}
          {{Form::time('hora_partido',$partido->hora_partido,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('hora_partido'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"hora_partido",
            'placeholder'=>"Hora del partido",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('hora_partido'))? 'in':''}}valid-feedback">
            {{$errors->has('hora_partido')?$errors->first('hora_partido'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>

          <div class="col-md-4 mb-3">
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

            </h4></center>
            <div class="was-validated">
                  {{Form::select('arbitro_id',$listArb,$partido->arbitro_id,['class'=>'custom-select','required'])}}
                  <div class="invalid-feedback">Seleccione un Arbitro</div>
            </div>
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
  <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
