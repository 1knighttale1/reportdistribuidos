<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Persona;
use App\Administrador;
class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('empty')) {
            $administrador = [];
        }else {
         $administrador = DB::table('personas') ->join('administradores' , 'administradores.persona_id','personas.id') -> select('nombre','ap_paterno','ap_materno','administradores.id')->get();
         $persona= DB::table('personas')
                     ->select('personas.id as ida','nombre','ap_paterno','ap_materno')
                     ->whereNotIn('id', DB::table('administradores')->select('administradores.persona_id'))
                     ->get();
        }
         return view('administrador.index')->with('datos',array(
                                                        'administradores'=>$administrador,
                                                        'personas'=>$persona));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $persona = Persona::find($id);
        //dd($personas);
        //return;
        return view('administrador.create')->with('persona',$persona);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = array(
            'user' => 'required|String',
            'password' => 'required|alpha_num',
            'password_confir' => 'required|same:password' );
        $mensajes = array(
            'user.required' => 'El campo nombre de administrador es obligatorio',
            'user.String' => 'El nombre de administrador no debe contener espacios',
            'password.required' => 'La contraseña es obligatoria',
            'password.alpha_num' => 'La contraseña debe tener números y letras',
            'password_confir.required' => 'La confirmación es requerida',
            'password_confir.same' => 'las contraseñas no coinciden', );
         $this->validate($request,$reglas,$mensajes);
            $administrador = new Administrador;
            $administrador->user = $request['user'];
            $administrador->password = $request['password'];
            $administrador->persona_id = $request['persona_id']; 
            $administrador->save();
            return redirect('administrador');
        
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
        $adm = Administrador::find($id);
        return view('administrador.edit')-> with('administrador', $adm);
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
            'user' => 'required|alpha',
            'password' => 'required|alpha_num',
            'password_confir' => 'required|same:password' 
            );
        $mensajes = array(
            'user.required' => 'El campo nombre de administrador es obligatorio',
            'user.alpha' => 'El nombre de administrador no debe contener espacios',
            'password.required' => 'La contraseña es obligatoria',
            'password.alpha_num' => 'La contraseña debe tener números y letras',
            'password_confir.required' => 'La confirmación es requerida',
            'password_confir.same' => 'Las contraseñas no coinciden', );
         $this->validate($request,$reglas,$mensajes);

            $administrador = Administrador::find($request['id']);
            $administrador->user=$request->input('user');
            $administrador->password=$request->input('password');
            $administrador->persona_id=$request->input('persona_id');
            $administrador->save();
            
            /*$administrador->user = $request['user'];
            $administrador->password = $request['password'];
            $administrador->persona_id = $request['id']; 
            $administrador->save();*/
            return redirect('administrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Administrador::destroy($id);
        return redirect ('administrador');
    }

    public function mostrar_resultados (){

        return view('partidos.result');
    }
}
