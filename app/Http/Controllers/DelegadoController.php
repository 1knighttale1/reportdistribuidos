<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Delegado;
use App\Persona;
class DelegadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//$delegado = Delegado::all();
    	$delegado = DB::table('personas')//debemos usar "join"
                     ->join('delegados','delegados.persona_id',
                        'personas.id')
                     ->select('nombre','ap_paterno','ap_materno','user','password','delegados.id')
                     ->get();
        
        return view('delegado.index')->with('delegados',$delegado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('delegado.create');

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $reglas = array(
            'ci' => 'required|min:100000|max:999999|numeric|unique:personas',
            'nombre' => 'required|String',
            'ap_paterno' => 'required|String',
            'ap_materno' => 'required|String',
            'email' => 'required|E-Mail|unique:personas',
            'user' => 'required|alpha',
            'password' => 'required|alpha_num',
            'password_confir' => 'required|same:password' 
            );
        $mensajes = array(
            'ci.unique' => 'El ci ya ha sido registrado', 
            'ci.min' => 'El ci debe tener al menos 6 dígitos',
            'ci.max' => 'El ci  no debe tener al más de 6 dígitos',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre solo debe contener letras',
            'ap_paterno.required' => 'El apellido paterno es obligatorio',
            'ap_paterno.string' => 'El apellido solo debe contener caracteres',
            'ap_materno.required' => 'El apellido materno es obligatorio',
            'ap_materno.string' => 'El apellido materno solo debe contener caractres',
            'email.unique' => 'El email ya ha sido registrado',
            'user.required' => 'El campo nombre de usuario es obligatorio',
            'user.alpha' => 'El nombre de usuario no debe contener espacios',
            'password.required' => 'La contraseña es obligatoria',
            'password.alpha_num' => 'La contraseña debe tener números y letras',
            'password_confir.required' => 'La confirmación es requerida',
            'password_confir.same' => 'las contraseñas no coinciden' );

        $errores = $this->validate($request,$reglas,$mensajes);
        
        if($errores)
        {
            $delegado = new Delegado;
            $persona = new Persona;

            $persona->ci = $request['ci'];
            $persona->nombre = $request['nombre'];
            $persona->ap_paterno = $request['ap_paterno'];
            $persona->ap_materno = $request['ap_materno'];
            $persona->email = $request['email'];
            $persona->fecha_nacimiento = $request['fecha_nacimiento'];

            $delegado->user = $request['user'];
            $delegado->password = $request['password'];
            //$delegado->persona_id = $request['id']; 

            $persona->save();
            $delegado->persona_id = $persona->id;
            $delegado->save();
            return redirect('delegado');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delegado = Delegado::find($id);
        /*$persona = DB::table('personas')->select('*')
                     ->where('personas.id',$delegado->persona_id)
                     ->get();*/
        $del = $delegado->persona_id;
        $persona = Persona::find($del);

        return view('delegado.edit')->with('datos',array('delegado' => $delegado, 
                                                         'persona' => $persona ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reglas = array(
            'nombre' => 'required|String',
            'ap_paterno' => 'required|String',
            'ap_materno' => 'required|String',
            'email' => 'required|E-Mail',
            'user' => 'required|alpha',
            'password' => 'required|alpha_num',
            'password_confir' => 'required|same:password' 
            );
        $mensajes = array(
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre solo debe contener letras',
            'ap_paterno.required' => 'El apellido paterno es obligatorio',
            'ap_paterno.string' => 'El apellido solo debe contener caracteres',
            'ap_materno.required' => 'El apellido materno es obligatorio',
            'ap_materno.string' => 'El apellido materno solo debe contener caractres',
            'user.required' => 'El campo nombre de usuario es obligatorio',
            'user.alpha' => 'El nombre de usuario no debe contener espacios',
            'password.required' => 'La contraseña es obligatoria',
            'password.alpha_num' => 'La contraseña debe tener números y letras',
            'password_confir.required' => 'La confirmación es requerida',
            'password_confir.same' => 'las contraseñas no coinciden' );

        $errores = $this->validate($request,$reglas,$mensajes);
        
        if($errores)
        {
            $delegado = Delegado::find($request['idde']);
            $persona =  Persona::find($request['idpe']);

            //$persona->ci = $request['ci'];
            $persona->nombre = $request['nombre'];
            $persona->ap_paterno = $request['ap_paterno'];
            $persona->ap_materno = $request['ap_materno'];
            $persona->email = $request['email'];
            $persona->fecha_nacimiento = $request['fecha_nacimiento'];

            $delegado->user = $request['user'];
            $delegado->password = $request['password'];
            //$delegado->persona_id = $request['id']; 

            $persona->save();
            //$delegado->persona_id = $persona->id;
            $delegado->save();
            return redirect('delegado');
        }


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Delegado::destroy($id);
        return redirect('delegado');

    }
}
