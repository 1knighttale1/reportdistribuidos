
<html>
<head>
	<br>
	<br>
	<br>
	<title>Personas que participaran en el fixture</title>
</head>
<body>
        <legend align="center"> <h1>Lista de Personas</h1></legend>

		<table  border=1>
				<tr>
					<td><b>Nro.</b></td>
					<td><b>C.I.</b></td>
					<td><b>Nombre</b></td>
					<td><b>Apellido Paterno</b></td>
					<td><b>Apellido Materno</b></td>
					<td><b>Fecha de Nacimiento</b></td>
					<td><b>Correo Electronic</b>o</td>
					<td><b>Opciones</b></td>
				</tr>
				<?php $i = 1; ?>
				@foreach ($personas as $persona)
				<tr>
					<td> {{ $i++ }} </td>
					<td> {{ $persona -> ci }} </td>
					<td> {{ $persona -> nombre }} </td>
					<td> {{ $persona -> ap_paterno }} </td>
					<td> {{ $persona -> ap_materno }} </td>
					<td> {{ $persona -> fecha_nacimiento}} </td>
					<td> {{ $persona -> email }} </td>
					<td> <a href="persona/edit/{{$persona->id}}"> Editar </a>
					<a href="persona/eliminar/{{ $persona->id}}"> Eliminar </a>
				    </td>
				</tr>
				@endforeach
		</table>
</body>
</html>
