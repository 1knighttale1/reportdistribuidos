<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Actividad</title>
  </head>
  <body>
    <style>

    .trans{
      background-color:#00BB00;
      color:#CC0000;
      position:absolute;
      text-align:center;
      top:50px;
      left:40px;
      padding:65px;
      font-size:25px;
      font-weight:bold;
      width:300px;
    }
  </style>
		@extends ('layout')
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">

    {{Form::open(array('method'=>'POST','route'=>'actividad.actualizar','class'=>'needs-validation','novalidate'))}}

      <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Editar Actividad</p></legend>

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
          <input type='hidden' name='id' value='{{Crypt::encrypt($actividad->id)}}'/>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          {{Form::label('nombre','Nombre de Actividad')}}
          {{Form::text('nombre',$actividad->nombre,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"nombre",
            'placeholder'=>"Nombre Actividad",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('nombre'))? 'in':''}}valid-feedback">
            {{$errors->has('nombre')?$errors->first('nombre'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          {{Form::label('fecha_inicio','Fecha de inicio')}}
          {{Form::date('fecha_inicio',$actividad->fecha_inicio,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"fecha_inicio",
            'placeholder'=>"Fecha de Inicio",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('fecha_inicio'))? 'in':''}}valid-feedback">
            {{$errors->has('fecha_inicio')?$errors->first('fecha_inicio'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>
        <div class="col-md-4 mb-3">
          {{Form::label('fecha_fin','Fecha de Fin')}}
          {{Form::date('fecha_fin',$actividad->fecha_fin,[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('fecha_fin'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"fecha_fin",
            'placeholder'=>"Fecha fin",'required']) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('fecha_fin'))? 'in':''}}valid-feedback">
            {{$errors->has('fecha_fin')?$errors->first('fecha_fin'):'¡Se ve bien!'}}
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
