<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
{{ Form::open(array('method'=>'POST','route'=>'persona.actualizar')) }}
{{ Form::hidden ('id', $persona['id'])}}
<br><br>
<h4>Editar Persona</h4>

    <label for="ci" >Carnet de Identidad:</label>
    <input type="number" name="ci" id="ci"  value="{{ old('ci', $persona->ci) }}" disabled="ci"><br><br>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre"  value="{{ old('nombre', $persona->nombre) }}"><br><br>


    <label for="ap_paterno">Apellido Paterno:</label>
    <input type="text" name="ap_paterno" id="ap_paterno"  value="{{ old('ap_paterno', $persona->ap_paterno) }}"><br><br>


    <label for="ap_materno">Apellido Materno:</label>
    <input type="text" name="ap_materno" id="ap_materno"  value="{{ old('ap_materno' ,$persona->ap_materno) }}"><br><br>


    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  value="{{ old('fecha_nacimiento', $persona->fecha_nacimiento)}}" ><br><br>


    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" value="{{ old('email' , $persona->email)}}" disabled="email"><br><br>

    {{Form::button('Actualizar',['type'=>"submit"]) }}
    
{{ Form::close() }}

</body>
</html>