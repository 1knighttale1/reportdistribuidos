<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividades</title>
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
        <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                            -moz-border-radius:20px;
                            border-radius: 20px;
                            -webkit-border-radius: 20px;
                            padding: 20px;">
        <legend class="w-auto"><h1 class='display-4 text-primary text-center'>Lista de Actividades para {{$grupo->nombre}}</h1></legend>
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
    <table class="table table-striped" >
      <thead>
        <tr>
          <th>No. </th> <th>Actividad</th> <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Opciones</th>
        </tr>
      </thead>

      <?php
      use Illuminate\Support\Facades\Crypt;
      $i=1;
      $actividades=$grupo->actividades()->get();
      ?>
      @foreach($actividades as $actividad)
      <tr>
        <td>{{$i++}}</td> <td>{{$actividad->nombre}}</td> <td>{{$actividad->fecha_inicio}}</td> <td>{{$actividad->fecha_fin}}</td>
        <td>
          <a href="/partido/ {{Crypt::encrypt($actividad->id)}}"
              target="_blank"
              class="btn btn-default btn-warning">Partidos</i>
          </a>
          <a href="/actividad/edit/ {{Crypt::encrypt($actividad->id)}}"
            class="btn btn-info btn-xs">editar</i>
          </a>
          {{Form::open(array('method'=>'Post','route'=>'actividad.eliminar','style'=>'display: inline;'))}}
               <input type="hidden" name="id" value="{{Crypt::encrypt($actividad->id)}}">
             <button class="btn btn-danger btn-xs"
                onclick="return confirm('Estas seguro de querer eliminar todos los datos relacionados a esta actividad?')">Eliminar</i>
             </button>
          {{Form::close()}}
        </td>
      </tr>
      @endforeach
    </table>
  </fieldset>
  </div>
  </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
