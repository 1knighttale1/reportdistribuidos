<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Editar jugador</title>
  </head>
  <body>
  <h2>EDITAR JUGADOR</h2>
      <br/>
    {{Form::open(array('method'=>'POST','route'=>'jugador.actualizar'))}}

          {{Form::label('ci','C.I.: ')}}
          {{Form::number('ci',$datos['persona']->ci,['id'=>"ci",'disabled']) }}<br><br>

          {{Form::label('nombre','Nombre de jugador: ')}}
          {{Form::text('nombre',$datos['persona']->nombre,['id'=>"nombre",'placeholder'=>"Nombre de jugador"]) }}<br><br>

          {{Form::label('ap_paterno','Apellido paterno: ')}}
          {{Form::text('ap_paterno',$datos['persona']->ap_paterno,['id'=>"ap_paterno",'placeholder'=>"Intro apellido"] ) }}<br><br>
          
          {{Form::label('ap_materno','Apellido materno: ')}}
          {{Form::text('ap_materno',$datos['persona']->ap_materno,['id'=>"ap_materno",'placeholder'=>"Intro apellido"])}}<br><br>
          
          {{Form::label('fecha_nacimiento','Fecha de nacimiento: ')}}
          {{Form::date('fecha_nacimiento',$datos['persona']->fecha_nacimiento,['id'=>"fecha_nacimiento",'placeholder'=>"Nombre de jugador"]) }}<br><br>

          {{Form::label('email','Correo electrónico: ')}}
          {{Form::text('email',$datos['persona']->email,['id'=>"email",'placeholder'=>"Nombre de jugador"]) }}<br><br>
          
          {{Form::label('numero','Número jugador: ')}}
          {{Form::text('numero',$datos['jugador']->numero,['id'=>"numero",'disabled']) }}<br><br>
          
          Nombre equipo: <select name='ideq'>
                @foreach($datos['equipo'] as $equipo)
                <option value='{{$equipo->ideq}}'>{{$equipo->nombre_equipo}}</option>
                @endforeach
              </select>

      {{Form::hidden('idpe', $datos['persona']->id )}}
      {{Form::hidden('idju', $datos['jugador']->id )}}<br><br>
      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success"])}}
      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger"])}}
      
    {{Form::close()}}
  </body>
</html>
