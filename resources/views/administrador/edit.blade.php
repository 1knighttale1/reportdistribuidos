<!DOCTYPE html>
<html>
<head>
	<title>editar Administrador</title>
</head>
<body>
		@extends('layout')
		{{ Form::open(array('method'=>'POST','route'=>'administrador.actualizar')) }}
		{{ Form::hidden ('id', $administrador->id)}}
      	{{ Form::hidden('persona_id', $administrador->persona_id )}}
		{{ csrf_field() }}
		<br><br><br>
		<h3> <b> Editar Administrador</b></h3>
                <div class="form-group">
                    <label for="user">Nombre de Administrador:</label>
                    <input type="text" class="form-control" name="user" id="user" placeholder="Admin1" value="{{ old('user' , $administrador -> user) }}">
                </div>
                @if($errors -> has('user'))
                    <font color="red">{{$errors->first('user')}}</font><br>
                    @endif
                <div class="form-group">
                    <label for="password">Introduzca la nueva contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="123654" value="{{ old('password' , $administrador -> password) }}">
                </div>
                @if($errors -> has('password'))
                    <font color="red">{{$errors->first('password')}}</font><br>
                    @endif

                <div class="form-group">
                    <label for="password_confir">Repita la nueva contraseña:</label>
                    <input type="password" class="form-control" name="password_confir" id="password_confir" placeholder="123654" value="{{ old('password_confir' , $administrador -> password_confir) }}">
                </div>
                @if($errors -> has('password_confir'))
                    <font color="red">{{$errors->first('password_confir')}}</font><br>
                 @endif
                 
                 {{Form::button('Actualizar Informacion',['type'=>"submit",'class'=>"btn btn-success"])}}


</body>
</html>