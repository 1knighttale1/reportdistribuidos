<!DOCTYPE html>
<html>
<head>
	<title> Administradores de Fixture</title>
</head>
<body>
		@extends ('layout')
		<br><br><br>
		<div class="btn-group" role="group" aria-label="...">
            <div class="btn-group" role="group">
               <select class="form-control" >
                @foreach($datos['personas'] as $persona)
                <option> {{$persona->nombre}} {{$persona->ap_paterno}} {{$persona->ap_materno}}</option>
                @endforeach
            </select>
            </div>
        </div>
         <a href="administrador/nuevo/{{$persona->ida}}"
                    target="_blank"
                    class="btn btn-default btn-warning">Seleccionar</i>
                </a>
		<table  class="table table-striped"  style="color: black; background:yellowgreen ; z-index:1;filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60">
			<br><br><br>
		<thead>
				<tr class="active" style="color: black">
					<td><b>ID</b></td>
					<td><b>Nombre</b></td>
					<td><b>Apellido Paterno</b></td>
					<td><b>Apellido Materno</b></td>
					<td><b>Nombre de Usuario</b></td>
				</tr>
		</thead>
		@if (! empty($datos))
			<?php ?>
		 	@foreach($datos['administradores'] as $administrador)
				<tr>
					<td style="color: black"> {{ $administrador -> id }} </td>
					<td> {{ $administrador -> nombre }} </td>
					<td> {{ $administrador -> ap_paterno}} </td>
					<td> {{ $administrador -> ap_materno }} </td>

					<td> <a href="administrador/edit/{{$administrador->id}}" class="btn btn-primary"> Editar Datos </a>
					<a href="administrador/eliminar/{{ $administrador->id}}" class="btn btn-danger"  onclick="return confirm ('¿Eliminar administrador?')"> Eliminar </a>
				    </td>
				</tr>
		 	@endforeach

			@endif
		</table>
</body>
</html>
