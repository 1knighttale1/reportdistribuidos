<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <title>FIXTURE</title>
    </head>
    <body>
        <div>
            <h1>Login</h1>
            {{Form::open(array('method'=>'POST','route'=>'login'))}}
              {{Form::text('username','',['class'=>'username','placeholder'=>'Nombre Usuario'])}}
              {{Form::password('password',['class'=>'password','placeholder'=>'Contraseña'])}}
              @if(session('estado'))

                <font color='red'>
                  <b>
                    {{ session('estado') }}
                  </b>
                </font>
              @endif
                <button type="submit">Ingresar</button>
            {{Form::close()}}
        </div>
    </body>

</html>
