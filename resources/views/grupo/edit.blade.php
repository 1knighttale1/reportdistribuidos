<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Grupo</title>
  </head>
  <body>
    @extends ('layout')
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">

    {{Form::open(array('method'=>'POST','route'=>'grupo.actualizar','class'=>'needs-validation','novalidate'))}}

      <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Editar Grupo</p></legend>

      <div class="panel panel-default">
			<div class="panel-body">
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
        <?php
        use Illuminate\Support\Facades\Crypt;
        ?>
          <input type='hidden' name='id' value='{{Crypt::encrypt($grupo->id)}}'/>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          {{Form::label('nombre','Nombre de Grupo')}}
          {{Form::text('nombre',$grupo->nombre,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"nombre",
            'placeholder'=>"Nombre Grupo",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('nombre'))? 'in':''}}valid-feedback">
            {{$errors->has('nombre')?$errors->first('nombre'):'¡Se ve bien!'}}
          </div>
          @endif
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
  </body>
</html>
