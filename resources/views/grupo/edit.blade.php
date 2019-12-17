<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Grupo</title>
  </head>
  <body>

    {{Form::open(array('method'=>'POST','route'=>'grupo.actualizar'))}}

      <p>Editar Grupo</p>

      <input type='hidden' name='id' value='{{ $grupo->id }}'/>
      
      {{Form::label('nombre','Nombre de Grupo')}}
      {{Form::text('nombre',$grupo->nombre,['id'=>"nombre",'placeholder'=>"Nombre Grupo",'required']) }}
      <br><br>
      
      {{ Form::button('Borrar',['type'=>"reset"]) }} 
      {{ Form::button('Guardar',['type'=>"submit"]) }}

    {{Form::close()}}

  </body>
</html>
