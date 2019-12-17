@extends('layout')
@section('title', "Registrar Persona")
@section('content')

 {{Form::open(array('method'=>'POST','route'=>'persona.guardar'))}}

 <br><br>
    <div class="card">
        <h4 class="card-header" style="color: black"> <b> Crear usuario</b></h4>
        <div class="card-body" >
                {{ csrf_field() }}

                    <label for="ci" style="color: black">Carnet de Identidad:
                    <input type="number" class="form-control" name="ci" id="ci" placeholder="123654" value="{{ old('ci') }}">
                </label>
                    @if($errors -> has('ci'))
                    <font color="red">{{$errors->first()}}</font><br>
                    @endif
                    <label for="nombre" style="color: black">Nombre:
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pedro" value="{{ old('nombre') }}">
              </label>
                    @if($errors -> has('nombre'))
                    <font color="red">{{$errors->first(nombre)}}</font><br>
                    @endif

                    <label for="ap_paterno"  style="color: black">Apellido Paterno:
                    <input type="text" class="form-control" name="ap_paterno" id="ap_paterno" placeholder="Perez" value="{{ old('ap_paterno') }}">
            </label>
                @if($errors -> has('ap_paterno'))
                    <font color="red">{{$errors->first(ap_paterno)}}</font><br>
                    @endif

                    <label for="ap_materno"  style="color: black">Apellido Materno:
                    <input type="text" class="form-control" name="ap_materno" id="ap_materno" placeholder="Quispe" value="{{ old('ap_materno') }}">
           </label>
                    @if($errors -> has('ap_materno'))
                    <font color="red">{{$errors->first(ap_materno)}}</font><br>
                    @endif

                    <label for="fe"  style="color: black">Fecha de Nacimiento:
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="1997-02-11" value="{{ old('fecha_nacimiento') }}">
                </label>
                    @if($errors -> has('ci'))
                    <font color="red">{{$errors->first()}}</font><br>
                    @endif

                    <label for="email" style="color: black" >Correo electrónico:
                    <input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
              </label>
                    @if($errors -> has('email'))
                    <font color="red">{{$errors->first(email)}}</font><br>
                    @endif
                    <button type="reset" class="btn-danger"style='width:70px;height:25px'> Borrar</button>
                    <button type="submit" class="btn-success" style='width:70px; height:25px'> Guardar</button>
        </div>
    </div>
@endsection
