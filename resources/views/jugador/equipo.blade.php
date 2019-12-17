<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar equipo</title>
  </head>
  <body>
    @extends ('layout3')
    <div class="container">
      <br/>
      <div class="panel panel-default">

      <div class="panel-body">
    {{Form::open(array('method'=>'POST','route'=>'jugador.crear'))}}

      <fieldset   style="border:2px groove #00FFFF; background:#DDFFFF;
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Seleccionar equipo</p></legend>

      <div class="panel panel-default">
      <div class="panel-body">



              <select name='id'>
                @foreach($equipos as $equipo)
                <option value='{{$equipo->id}}'>{{$equipo->nombre_equipo}}</option>
                @endforeach
              </select>
                @if(session('mensaje'))
                  {{ session('mensaje') }} <br>
                @endif



      {{Form::button('Seleccionar',['type'=>"submit",'class'=>"btn btn-success"])}}

      </div>
      </div>
    </fieldset>

    {{Form::close()}}
    @if(session('estado'))
    <br>
    <br>
      <div class="alert alert-success" role="alert">
          {{ session('estado') }}
      </div>
    @endif
    </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
