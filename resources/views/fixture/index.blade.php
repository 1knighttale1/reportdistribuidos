<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <title>Fixture</title>
  </head>
  <body>
      @extends ('layout')
      <br><br>
    <div class="container">
      <br/>
      <div class="panel panel-default">

			<div class="panel-body">
        @if(session('estado'))

          <div class="alert alert-success" role="alert">
              {{ session('estado') }}
          </div>
        @endif
    <table class="table table-striped " style="color: black; background:yellowgreen ; z-index:1;filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60">
      <thead>
        <tr>
          <th>No. </th> <th>Fixture</th> <th>Estado</th> <th>Opciones</th>
        </tr>
      </thead>

      <?php
      use Illuminate\Support\Facades\Crypt;
      $i=1;
      ?>
      @foreach($fixtures as $fixture)
      <tr>
        <td>{{$i++}}</td> <td>{{$fixture->nombre}}</td> <td>{{$fixture->estado}}</td>
        <td>
          <a href="/fixture/rol/ {{Crypt::encrypt($fixture->id)}}"
              target="_blank"
              class="btn btn-default btn-primary">Rol</i>
          </a>
          <a href="/fixture/resultados/ {{Crypt::encrypt($fixture->id)}}"
              target="_blank"
              class="btn btn-default btn-secondary">Resultados</i>
          </a>
          <a href="/grupo/ {{Crypt::encrypt($fixture->id)}}"
              target="_blank"
              class="btn btn-default btn-warning">grupos</i>
          </a>
          <a href="/fixture/edit/ {{Crypt::encrypt($fixture->id)}}"
            class="btn btn-info btn-xs">editar</i>
          </a>
          <a href="/fixture/eliminar/ {{Crypt::encrypt($fixture->id)}}"
            class="btn btn-info btn-danger">Eliminar</i>
          </a>
        </td>
      </tr>
      @endforeach
    </table>

  </div>
  </div>
  </div>
    </body>
</html>
