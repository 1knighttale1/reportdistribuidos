<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Equipo</title>
  </head>
  <body>
      @extends ('layout')
      <br><br>
    <div class="container">
      <br/>
      <div class="panel panel-default">

      <div class="panel-body">
        <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.70);
                            -moz-border-radius:20px;
                            border-radius: 20px;
                            -webkit-border-radius: 20px;
                            padding: 20px;">
        <legend class="w-auto"><h1 class='display-4 text-primary text-center'>Lista de Equipos</h1></legend>

    <table class="table table-striped" >

      <a href="equipo/nuevo"
                    target="_blank"
                    class="btn btn-default btn-warning">Nuevo</i>
      </a><br>
      <tr>
        <td>No. </td> <td>Nombre de equipo</td> <td>Color</td> <td>Delegado</td><td>Opciones</td>
      </tr>
      <?php
      use Illuminate\Support\Facades\Crypt;
      $i=1;
      ?>
      @foreach($equipos as $equipo)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$equipo->nombre_equipo}}</td>
        <td>{{$equipo->color}}</td>
        <td>{{$equipo->nombre}} {{$equipo->ap_paterno}} {{$equipo->ap_materno}}</td>
        <td>
          <a href="equipo/editar/{{$equipo->ideq}}"
              target="_blank"
              class="btn btn-default btn-primary">Editar</i>
          </a>
          <a href="equipo/eliminar/{{$equipo->ideq}}"
             onclick = "return confirm ('¿Eliminar equipo?')"
            class="btn btn-danger btn-xs">Eliminar</i>
          </a>
        </td>
      </tr>
      @endforeach
    </table>
  </fieldset>
  </div>
  </div>
  </div></body>
</html>
