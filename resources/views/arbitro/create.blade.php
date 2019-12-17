<!DOCTYPE html>
<html>
<head>
	@extends('layout')
	<title>nuevo arbitro</title>

</head>
<body>
	@extends ('layout')
{{Form::open(array('method'=>'POST','route'=>'arbitro.guardar'))}}
          {{Form::hidden('id', $persona->id )}}
		{{ csrf_field() }}
		<br><br>
		<h2> <b> Registrar nuevo Arbitro</b></h2>
                <input type='hidden' name='persona_id' value='{{$persona->id}}'/>
                <div class="form-group">
                    <label for="user">Nombre de Arbitro:</label>
                    <input type="text" class="form-control" name="user" id="user" placeholder="Arbitro1" value="{{ old('user') }}">
                </div>
                    @if($errors -> has('user'))
                    <font color="red">{{$errors->first('user')}}</font><br>
                    @endif

                <div class="form-group">
                    <label for="password">Introduzca contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="123654" value="{{ old('password') }}">
                </div>
                	@if($errors -> has('password'))
                    <font color="red">{{$errors->first('password')}}</font><br>
                    @endif

                 <div class="form-group">
                    <label for="password_confir">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="password_confir" id="password_confir" placeholder="123654" value="{{ old('password_confir') }}">
                </div>
                    @if($errors -> has('password_confir'))
                    <font color="red">{{$errors->first('password_confir')}}</font><br>
                    @endif
                    {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger"])}}
                    {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success"])}}
</body>
</html>
