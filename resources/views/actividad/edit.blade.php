<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Actividad</title>
  </head>
  <body>
      <br/>

    {{Form::open(array('method'=>'POST','route'=>'actividad.actualizar'))}}
    <p>Editar Actividad</p>
     
    <input type='hidden' name='id' value='{{ $actividad->id }}'/>
          {{Form::label('nombre','Nombre de Actividad')}}
          {{Form::text('nombre',$actividad->nombre,['id'=>"nombre",'placeholder'=>"Nombre Actividad",'required']) }}
          <br><br>
          
          {{Form::label('fecha_inicio','Fecha de inicio')}}
          {{Form::date('fecha_inicio',$actividad->fecha_inicio,['id'=>"fecha_inicio",'placeholder'=>"Fecha de Inicio",'required']) }}
          <br><br>

          {{Form::label('fecha_fin','Fecha de Fin')}}
          {{Form::date('fecha_fin',$actividad->fecha_fin,['id'=>"fecha_fin",'placeholder'=>"Fecha fin",'required']) }}
          <br><br>

      {{Form::button('Borrar',['type'=>"reset"])}}
      {{Form::button('Guardar',['type'=>"submit"])}}
    {{Form::close()}}
  </body>
</html>
