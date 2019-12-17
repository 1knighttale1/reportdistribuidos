<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Arbitro;
use App\Persona;

class ArbitroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if (request()->has('empty')) {
            $arbitro = [];
        }else {
         $arbitro = DB::table('personas') ->join('arbitros' , 'arbitros.persona_id','personas.id') -> select('nombre','ap_paterno','ap_materno','arbitros.id')->get();
         $persona= DB::table('personas')
                     ->select('personas.id as idar','nombre','ap_paterno','ap_materno')
                     ->whereNotIn('id', DB::table('arbitros')->select('arbitros.persona_id'))
                     ->get();
        }
         return view('arbitro.index')->with('datos',array(
                                                        'arbitros'=>$arbitro,
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
        return view('arbitro.create')->with('persona',$persona);
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
            $arbitro = new Arbitro;
            $arbitro->user = $request['user'];
            $arbitro->password = $request['password'];
            $arbitro->persona_id = $request['persona_id']; 
            $arbitro->save();
            return redirect('arbitro');
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
         $arbitro = Arbitro::find($id);
            return view('arbitro.edit')-> with('arbitro', $arbitro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $reglas = array(
            'user' => 'required|alpha',
            'password' => 'required|alpha_num',
            'password_confir' => 'required|same:password' 
            );
        $mensajes = array(
            'user.required' => 'El campo nombre de arbitro es obligatorio',
            'user.alpha' => 'El nombre de arbitro no debe contener espacios',
            'password.required' => 'La contraseña es obligatoria',
            'password.alpha_num' => 'La contraseña debe tener números y letras',
            'password_confir.required' => 'La confirmación es requerida',
            'password_confir.same' => 'Las contraseñas no coinciden', );
         $this->validate($request,$reglas,$mensajes);

            $arbitro = Arbitro::find($request['id']);
            $arbitro->user=$request->input('user');
            $arbitro->password=$request->input('password');
            $arbitro->persona_id=$request->input('persona_id');
            $arbitro->save();
            
            /*$arbitro->user = $request['user'];
            $arbitro->password = $request['password'];
            $arbitro->persona_id = $request['id']; 
            $arbitro->save();*/
            return redirect('arbitro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Arbitro::destroy($id);
        return redirect ('arbitro');
    }
}
