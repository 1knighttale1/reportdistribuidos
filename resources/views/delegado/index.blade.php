<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Delegado</title>
  </head>
  <body>
    @extends ('layout')
    <br>
    <div class="container">
      <br/>
      <div class="panel panel-default">

      <div class="panel-body">
        <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.8);
                            -moz-border-radius:20px;
                            border-radius: 20px;
                            -webkit-border-radius: 20px;
                            padding: 20px;">
        <legend class="w-auto"><h1 class='display-4 text-primary text-center'>Lista de delegados</h1></legend>

        <table class="table table-striped" >
                <a href="delegado/nuevo"
                    target="_blank"
                    class="btn btn-default btn-warning">Nuevo</i>
                </a>
      </div>

      <tr>
        <td>No. </td> <td>Usuario</td> <td>Persona</td> <td>Contraseña</td> <td>Opciones</td>
      </tr>
      <?php
      use Illuminate\Support\Facades\Crypt;
      $i=1;
      ?>
      @foreach($delegados as $delegado)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$delegado->user}}</td>
        <td>{{$delegado->nombre}} {{$delegado->ap_paterno}} {{$delegado->ap_materno}}</td>
        <td>{{$delegado->password}}</td>
        <td>
          <a href="delegado/editar/{{$delegado->id}}"
              class="btn btn-default btn-primary">Editar</i>
          </a>
          <a href="delegado/eliminar/{{$delegado->id}}"
             onclick="return confirm ('¿ELIMINAR DELEGADO?')"
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

  </body>
</html>
