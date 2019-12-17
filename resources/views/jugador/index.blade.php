<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Jugador</title>
  </head>
  <body>
  <H2>LISTA DE JUGADORES</H2>
    <br>
    <table border="1">
      <tr>
        <td>No. </td> <td>Persona</td> <td>Nro. camiseta</td> <td>Equipo</td> <td>Opciones</td>
      </tr>
      <?php $i=1; ?>
      @foreach($personas as $persona)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$persona->nombre}} {{$persona->ap_paterno}} {{$persona->ap_materno}}</td>
        <td>{{$persona->numero}}</td>
        <td>{{$persona->nombre_equipo}}</td>
        <td>
          <a href="jugador/editar/{{$persona->idju}}">Editar</a> |
          <a href="jugador/eliminar/{{$persona->idju}}">Eliminar</a>
        </td>
      </tr>
      @endforeach
    </table><br>
    <a href="jugador/nuevo">NUEVO</a>
  </body>
</html>
