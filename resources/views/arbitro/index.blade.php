<!DOCTYPE html>
<html>
<head>
	<title> Arbitros </title>
</head>
<body>
	  
<h2>ARBITROS</h2>

	<br>    
        <select>
            @foreach($datos['personas'] as $persona)
            <option> {{$persona->nombre}} {{$persona->ap_paterno}} {{$persona->ap_materno}}</option>
            @endforeach
    	</select>
            
         <a href="arbitro/nuevo/{{$persona->idar}}">Seleccionar</a> 
           <br><br><br>       
		<table border="1">
		<thead>
				<tr class="active">
					<td><b>ID</b></td>
					<td><b>Nombre</b></td>
					<td><b>Apellido Paterno</b></td>
					<td><b>Apellido Materno</b></td>
					<td><b>Opciones</b></td>
					
				</tr>
		</thead>
		@if (! empty($datos))	
			@foreach($datos['arbitros'] as $arbitro)
				<tr>
					<td> {{ $arbitro -> id }} </td>
					<td> {{ $arbitro -> nombre }} </td>
					<td> {{ $arbitro -> ap_paterno}} </td>
					<td> {{ $arbitro -> ap_materno }} </td>
					<td> <a href="arbitro/edit/{{$arbitro->id}}" > Editar Datos</a> |
					<a href="arbitro/eliminar/{{ $arbitro->id}}" > Eliminar </a>
				    </td>
				</tr>
		 	@endforeach
		@endif
		</table>
</body>
</html>