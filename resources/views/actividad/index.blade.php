<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividades</title>
  </head>
  <body>
      <br/>
      <h1>Lista de Actividades para {{$grupo->nombre}}</h1>

      <table border="1">

        <tr>
          <th>No. </th> <th>Actividad</th> <th>Fecha Inicio</th> <th>Fecha Fin</th> <th>Opciones</th>
        </tr>

        @foreach($actividades as $actividad)
        <tr>
          <td>{{$i++}}</td> 
          <td>{{$actividad->nombre}}</td> 
          <td>{{$actividad->fecha_inicio}}</td> 
          <td>{{$actividad->fecha_fin}}</td>
          <td>
            <a href="/partido/ {{ $actividad->id }}">Partidos</a>
            <a href="/actividad/edit/ {{ $actividad->id }}">editar</a>

            {{ Form::open(array('method'=>'Post','route'=>'actividad.eliminar')) }}
              <input type="hidden" name="id" value="{{ $actividad->id }}">
              <button>Eliminar</button>
            {{ Form::close() }}
          </td>
        </tr>
        @endforeach
      </table>
    </body>
</html>
