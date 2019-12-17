<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
</head>
<body>
{{Form::open(array('method'=>'POST','route'=>'persona.guardar'))}}
<br><br>

       <h4><b> Crear usuario</b></h4>
 
        <label for="ci">Carnet de Identidad:
        <input type="number" name="ci" id="ci" placeholder="123654" value="{{ old('ci') }}">
        </label><br><br>
        
        <label for="nombre">Nombre:
        <input type="text" name="nombre" id="nombre" placeholder="Pedro" value="{{ old('nombre') }}">
        </label><br><br>

        <label for="ap_paterno" >Apellido Paterno:
        <input type="text" name="ap_paterno" id="ap_paterno" placeholder="Perez" value="{{ old('ap_paterno') }}">
        </label><br><br>


        <label for="ap_materno" >Apellido Materno:
        <input type="text" name="ap_materno" id="ap_materno" placeholder="Quispe" value="{{ old('ap_materno') }}">
        </label><br><br>


        <label for="fe" >Fecha de Nacimiento:
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="1997-02-11" value="{{ old('fecha_nacimiento') }}">
        </label><br><br>


        <label for="email" >Correo electrónico:
        <input type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
        </label><br><br>

        <button type="reset"> Borrar</button>
        <button type="submit"> Guardar</button>
{{ Form::close() }}
</body>
</html>
 
 

