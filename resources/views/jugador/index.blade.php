<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jugador</title>
  </head>
  <body>
    @extends('layout3')
    <br>
    <div class="container">
      <br/>
      <div class="panel panel-default">

      <div class="panel-body">
        <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.70);
                            -moz-border-radius:20px;
                            border-radius: 20px;
                            -webkit-border-radius: 20px;
                            padding: 20px;">
        <legend class="w-auto"><h1 class='display-4 text-primary text-center'>Lista de jugadores</h1></legend>

        <table class="table table-striped" >
                <a href="jugador/nuevo"
                    target="_blank"
                    class="btn btn-default btn-warning">Nuevo</i>
                </a>
      </div>

      <tr>
        <td>No. </td> <td>Persona</td> <td>Nro. camiseta</td> <td>Equipo</td> <td>Opciones</td>
      </tr>
      <?php
      use Illuminate\Support\Facades\Crypt;
      $i=1;
      ?>
      @foreach($personas as $persona)
      <tr>
        <td>{{$i++}}</td>

        <td>{{$persona->nombre}} {{$persona->ap_paterno}} {{$persona->ap_materno}}</td>
        <td>{{$persona->numero}}</td>
        <td>{{$persona->nombre_equipo}}</td>
        <td>
          <a href="jugador/editar/{{$persona->idju}}"
              class="btn btn-default btn-primary">Editar</i>
          </a>
          <a href="jugador/eliminar/{{$persona->idju}}"
             onclick="return confirm ('¿ELIMINAR JUGADOR?')"
             class="btn btn-danger btn-primary" >Eliminar</i>
          </a>

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
