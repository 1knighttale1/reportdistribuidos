<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grupos</title>
  </head>
  <body>
      <br/>
      <h1>Lista de Grupos para {{$fixture->nombre}}</h1>
      
    <table border="1">
      <tr>
        <th>No. </th> <th>Grupo</th><th>Opciones</th>
      </tr>

      <?php
      $i=1;
      $grupos=$fixture->grupos()->get();
      ?>
      @foreach($grupos as $grupo)
      <tr>
        <td>{{$i++}}</td> <td>{{$grupo->nombre}}</td>
        <td>
          <a href="/actividad/ {{ $grupo->id }}">Actividades</a>
          <a href="/grupo/edit/ {{ $grupo->id }}">editar</a>

          {{ Form::open(array('method'=>'Post','route'=>'grupo.eliminar')) }}
               <input type="hidden" name="id" value="{{ $grupo->id }}">
             <button>Eliminar</i>
             </button>
          {{Form::close()}}
        </td>
      </tr>
      @endforeach
    </table>
  </body>
</html>
