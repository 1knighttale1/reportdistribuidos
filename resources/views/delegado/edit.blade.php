<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insertar delegado</title>
  </head>
  <body>
    @extends ('layout')
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">
    {{Form::open(array('method'=>'POST','route'=>'delegado.actualizar'))}}

      <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.8);
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Editar delegado</p></legend>

      <div class="panel panel-default">
			<div class="panel-body">

      <div class="form-group">

          {{Form::label('ci','C.I.: ')}}
          {{Form::number('ci',$datos['persona']->ci,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('ci'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"ci",
            'disabled']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('ci'))? 'in':''}}valid-feedback">
            {{$errors->has('ci')?$errors->first('ci'):'¡Se ve bien!'}}
          </div>
          @endif

          <br>

          {{Form::label('nombre','Nombre de delegado: ')}}
          {{Form::text('nombre',$datos['persona']->nombre,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"nombre",
            'placeholder'=>"Nombre de delegado"]) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('nombre'))? 'in':''}}valid-feedback">
            {{$errors->has('nombre')?$errors->first('nombre'):'¡Se ve bien!'}}
          </div>
          @endif

        <br>
        <div class="form-group">
          {{Form::label('ap_paterno','Apellido paterno: ')}}
          {{Form::text('ap_paterno',$datos['persona']->ap_paterno,[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('ap_paterno'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"ap_paterno",
            'placeholder'=>"Intro apellido"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('ap_paterno'))? 'in':''}}valid-feedback">
            {{$errors->has('ap_paterno')?$errors->first('ap_paterno'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>
        <div class="form-group">
          {{Form::label('ap_materno','Apellido materno: ')}}
          {{Form::text('ap_materno',$datos['persona']->ap_materno,[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('ap_materno'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"ap_materno",
            'placeholder'=>"Intro apellido"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('ap_materno'))? 'in':''}}valid-feedback">
            {{$errors->has('ap_materno')?$errors->first('ap_materno'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>

        {{Form::label('fecha_nacimiento','Fecha de nacimiento: ')}}
          {{Form::date('fecha_nacimiento',$datos['persona']->fecha_nacimiento,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('fecha_nacimiento'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"fecha_nacimiento",]) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('fecha_nacimiento'))? 'in':''}}valid-feedback">
            {{$errors->has('fecha_nacimiento')?$errors->first('fecha_nacimiento'):'¡Se ve bien!'}}
          </div>
          @endif <br>

          {{Form::label('email','Correo electrónico: ')}}
          {{Form::text('email',$datos['persona']->email,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('email'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"email",
            'placeholder'=>"Correo jugador"]) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('email'))? 'in':''}}valid-feedback">
            {{$errors->has('email')?$errors->first('email'):'¡Se ve bien!'}}
          </div>
          @endif
          <br>


          {{Form::label('user','Nombre de Usuario')}}
          {{Form::text('user',$datos['delegado']->user,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('user'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"user",
            'placeholder'=>"Nombre de usuario"]) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('user'))? 'in':''}}valid-feedback">
            {{$errors->has('user')?$errors->first('user'):'¡Se ve bien!'}}
          </div>
          @endif

        <br>
        <div class="form-group">
          {{Form::label('password','Contraseña: ')}}
          {{Form::number('password','',[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('password'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"password",
            'placeholder'=>"Intro contraseña"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('password'))? 'in':''}}valid-feedback">
            {{$errors->has('password')?$errors->first('password'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>
        <div class="form-group">
          {{Form::label('password_confir','Confirmar contraseña: ')}}
          {{Form::number('password_confir','',[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('password_confir'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"password_confir",
            'placeholder'=>"Intro contraseña"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('password_confir'))? 'in':''}}valid-feedback">
            {{$errors->has('password_confir')?$errors->first('password_confir'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>

      </div>

      {{Form::hidden('idpe', $datos['persona']->id )}}
      {{Form::hidden('idde', $datos['delegado']->id )}}
      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger",'style'=>'width:150px;height:35px'])}}
      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success",'style'=>'width:150px;height:35px'])}}

      </div>
      </div>
    </fieldset>

    {{Form::close()}}

    @if(session('estado'))
    <br>
    <br>
      <div class="alert alert-success" role="alert">
          {{ session('estado') }}
      </div>
    @endif
    </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
