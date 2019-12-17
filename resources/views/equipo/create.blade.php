<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insertar equipo</title>
  </head>
  <body>
    @extends ('layout')
    <br>
    <div class="container">
      <br/>
      <div class="panel panel-default">

      <div class="panel-body">
    {{Form::open(array('method'=>'POST','route'=>'equipo.guardar'))}}

      <fieldset   style="border:2px groove #00FFFF; background:rgb(230,230,230,0.70);
                          -moz-border-radius:20px;
                          border-radius: 20px;
                          -webkit-border-radius: 20px;
                          padding: 20px;">
      <legend class="w-auto"><p class='display-4 text-primary'>Nuevo equipo</p></legend>

      <div class="panel panel-default">
      <div class="panel-body">

      <div class="form-group">

          {{Form::label('nombre_equipo','Nombre de Equipo')}}
          {{Form::text('nombre_equipo','',[
            'class'=>'form-control '.( ($errors->isNotEmpty())?
                (($errors->has('nombre_equipo'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"nombre_equipo",
            'placeholder'=>"Nombre de equipo"]) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('nombre_equipo'))? 'in':''}}valid-feedback">
            {{$errors->has('nombre_equipo')?$errors->first('nombre_equipo'):'¡Se ve bien!'}}
          </div>
          @endif

        <br>
        <div class="form-group">
          {{Form::label('color','Color: ')}}
          {{Form::text('color','',[
            'class'=>'form-control '.(
              ($errors->isNotEmpty())?
            (($errors->has('color'))? 'is-invalid' : 'is-valid'): '' ),
            'id'=>"color",
            'placeholder'=>"Intro color"
          ] ) }}
          @if(($errors->isNotEmpty()))
          <div class="{{($errors->has('color'))? 'in':''}}valid-feedback">
            {{$errors->has('color')?$errors->first('color'):'¡Se ve bien!'}}
          </div>
          @endif
        </div>

              <select class="form control" name='idde'>
                @foreach($delegados as $delegado)
                <option value='{{$delegado->idde}}'>{{$delegado->nombre}} {{$delegado->ap_paterno}} {{$delegado->ap_materno}}</option>
                @endforeach
              </select>
                @if(session('mensaje'))
                  {{ session('mensaje') }} <br>
                @endif
      </div>

      {{Form::button('Borrar',['type'=>"reset",'class'=>"btn btn-danger",'style'=>'width:150px;height:35px'])}}
      {{Form::button('Guardar',['type'=>"submit",'class'=>"btn btn-success",'style'=>'width:150px;height:35px'])}}

      </div>
      </div>
    </fieldset>

    {{Form::close()}}
    @if(session('estado'))
    <br>
    <br>
      <div class="alert alert-success" role="alert">
          {{ session('estado') }}
      </div>
    @endif
    </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
