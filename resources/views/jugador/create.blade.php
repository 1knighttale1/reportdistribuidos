<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insertar jugador</title>
  </head>
  <body>
  <h2>NUEVO JUGADOR</h2>

    {{Form::open(array('method'=>'POST','route'=>'jugador.guardar'))}}

          {{Form::label('ci','C.I.: ')}}
          {{Form::number('ci','',['id'=>"ci",'placeholder'=>"CI jugador"]) }}
          <br><br>

          {{Form::label('nombre','Nombre de jugador: ')}}
          {{Form::text('nombre','',['id'=>"nombre",'placeholder'=>"Nombre de jugador"]) }}
          <br><br>
      
          {{Form::label('ap_paterno','Apellido paterno: ')}}
          {{Form::text('ap_paterno','',['id'=>"ap_paterno",'placeholder'=>"Intro apellido"] ) }}
          <br><br>
        
          {{Form::label('ap_materno','Apellido materno: ')}}
          {{Form::text('ap_materno','',['id'=>"ap_materno",'placeholder'=>"Intro apellido"] ) }}
          <br><br>
          
          {{Form::label('fecha_nacimiento','Fecha de nacimiento: ')}}
          {{Form::date('fecha_nacimiento','',['id'=>"fecha_nacimiento",]) }}
          <br><br>

          {{Form::label('email','Correo electrónico: ')}}
          {{Form::text('email','',['id'=>"email",'placeholder'=>"Correo jugador"]) }}
          <br><br>
          
          {{Form::label('numero','Número jugador: ')}}
          {{Form::text('numero','',['id'=>"numero",'placeholder'=>"Número de jugador"]) }}
          <br><br>
          
          Nombre equipo: <select name='ideq'>
                          @foreach($datos['equipo'] as $equipo)
                          <option value='{{$equipo->id}}'>{{$equipo->nombre_equipo}}</option>
                          @endforeach
                        </select>
          <br><br>

      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success"])}}
      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger"])}}
      

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
