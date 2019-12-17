<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Intruducir Resultados</title>
  </head>
  <body style="background: url(/img/backgrounds/pelota.jpg);
  font-family: 'PT Sans', Helvetica, Arial, sans-serif;
  text-align: center;
  
  background-repeat: no-repeat:;
  background-size: 100%;">
    <div class="container">
      <br/>
    <div class="panel panel-default">

		<div class="panel-body">

    {{Form::open(array('method'=>'POST','route'=>'partido.guardar_resultado','class'=>'needs-validation','novalidate'))}}

      <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Intruducir Resultados De Partido</p></legend>
      <div class="panel panel-default">
			<div class="panel-body">
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
          <input type='hidden' name='id' value='{{Crypt::encrypt($partido->id)}}'/>
          <?php use App\Equipo; ?>
      <div class="form-row">
            <div class="col-md-4 mb-3">
              {{Form::label('goles_local',Equipo::find($partido->local_id)->nombre_equipo,['class'=>'display-4']) }}
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <font size='5'>GOLES:</font>
                </div>
                    <div class="col-md-4 mb-3">
              {{Form::number('goles_local','0',['class'=>'form-control']) }}
                    </div>
              </div>

            </div>
            <div class="col-md-4 mb-3 " align='center'>
              <br>
              {{Form::label('local','VS',['class'=>'display-4 txt-primary'])}}
            </div>
            <div class="col-md-4 mb-3">
              {{Form::label('goles_visitante',Equipo::find($partido->visitante_id)->nombre_equipo,['class'=>'display-4']) }}
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <font size='5'>GOLES:</font>
                </div>
                    <div class="col-md-4 mb-3">
              {{Form::number('goles_visitante','0',['class'=>'form-control']) }}
                    </div>
              </div>
            </div>
      </div>
      </div>
      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger"])}}
      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success"])}}

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
