<!DOCTYPE html>
<html>
<head>
	<title> Arbitros </title>
</head>
<body>
	  <style>
    
    .trans{
      background-color:#00BB00;
      color:#CC0000;
      position:absolute;
      text-align:center;
      top:50px;
      left:40px;
      padding:65px;
      font-size:25px;
      font-weight:bold;
      width:300px;
    }
  </style>
		@extends ('layout')

		<br><br><br>

	 <link rel="stylesheet" href="css/style.css">
	<div class="btn-group" role="group" aria-label="..." class="trans" style="z-index:1;filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60" >
            <div class="btn-group" role="group">
                
               <select class="form-control" >
                @foreach($datos['personas'] as $persona)
                <option> {{$persona->nombre}} {{$persona->ap_paterno}} {{$persona->ap_materno}}</option>
                @endforeach
            </select>
            </div>
        </div> 
         <a href="arbitro/nuevo/{{$persona->idar}}"
                    target="_blank"
                    class="btn btn-default btn-warning">Seleccionar</i>
                </a> 
           <br><br><br>       
		<table  class="table table-striped" style="color: black; background:yellowgreen ; z-index:1;filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60">
		<thead>
				<tr class="active">
					<td><b>ID</b></td>
					<td><b>Nombre</b></td>
					<td><b>Apellido Paterno</b></td>
					<td><b>Apellido Materno</b></td>
					
				</tr>
		</thead>
		@if (! empty($datos))	
			@foreach($datos['arbitros'] as $arbitro)
				<tr>
					<td> {{ $arbitro -> id }} </td>
					<td> {{ $arbitro -> nombre }} </td>
					<td> {{ $arbitro -> ap_paterno}} </td>
					<td> {{ $arbitro -> ap_materno }} </td>
					<td> <a href="arbitro/edit/{{$arbitro->id}}" class="btn btn-primary"> Editar Datos </a> 
					<a href="arbitro/eliminar/{{ $arbitro->id}}" class="btn btn-danger"  onclick="return confirm ('¿Eliminar arbitro?')"> Eliminar </a>
				    </td>
				</tr>
		 	@endforeach
			@endif
		</table>
</body>
</html>