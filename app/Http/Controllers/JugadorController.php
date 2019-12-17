<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jugador;
use App\Equipo;
use App\Persona;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(isset($delegado))
        $id=$delegado->equipo()->get()->last()->id;
      else {
        $id=0;
      }
      if($id==0){
    	$persona = DB::table('jugadores')
    	             ->join('personas','personas.id','jugadores.persona_id')
    	             ->join('equipos','equipos.id','jugadores.equipo_id')
    	             ->select('numero','nombre','ap_paterno','ap_materno','nombre_equipo',
    	             	      'jugadores.id as idju','personas.id as idpe','equipos.id as ideq')
    	             ->get();
      }
      else{
        $persona = DB::table('jugadores')
      	             ->join('personas','personas.id','jugadores.persona_id')
      	             ->join('equipos','equipos.id','jugadores.equipo_id')->where('jugadores.equipo_id',$id)
      	             ->select('numero','nombre','ap_paterno','ap_materno','nombre_equipo',
      	             	      'jugadores.id as idju','personas.id as idpe','equipos.id as ideq')
      	             ->get();

      }
        return view('jugador.index')->with('personas',$persona);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function equipo()
    {
        $equipo = DB::table('equipos')
                    ->select('id','nombre_equipo')
                    ->get();
        return view('jugador.equipo')->with('equipos',$equipo);
    }*/


    public function create()
    {
        //$count = Jugador::where('id',$request['id'])
          //               ->count();
        //if($count < 12)
        //{
            //$ideq = $request['ideq'];
            $idpersona = Persona::select('id')->orderby('created_at','DESC')->first();
            $equipo = DB::table('equipos')
                        ->select('id', 'nombre_equipo')
                        ->get();
            return view('jugador.create')->with('datos', array('idpersona' => $idpersona,
                                                               'equipo' => $equipo));
        //}
        /*else
        {
            return redirect('jugador.equipo')->with('mensaje','El equipo ya posee 11 miembros');
        }*/
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
            'ci' => 'required|min:100000|max:999999|numeric|unique:personas',
            'nombre' => 'required|String',
            'ap_paterno' => 'required|String',
            'ap_materno' => 'required|String',
            'email' => 'required|E-Mail|unique:personas',
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
            'email.unique' => 'El email ya ha sido registrado');

        $errores = $this->validate($request,$reglas,$mensajes);
        if($errores)
        {
            $count = Jugador::where('equipo_id',$request['ideq'])
                            ->count();
            if($count <= 10)
            {
                $numerorep = DB::table('jugadores')
                            ->where('equipo_id',$request['ideq'])
                            ->where('numero',$request['numero'])
                            ->get()
                            ->last();

                if(is_null($numerorep))
                {
                    $persona = new Persona;
                    $jugador = new Jugador;

                    $id = $persona->id;

                    $persona->ci = $request['ci'];
                    $persona->nombre = $request['nombre'];
                    $persona->ap_paterno = $request['ap_paterno'];
                    $persona->ap_materno = $request['ap_materno'];
                    $persona->fecha_nacimiento = $request['fecha_nacimiento'];
                    $persona->email = $request['email'];
                    $jugador->numero = $request['numero'];
                    $jugador->equipo_id = $request['ideq'];
                    //$jugador->persona_id = $id;

                    $persona->save();
                    $jugador->persona_id = $persona->id;
                    $jugador->save();
                    return redirect('jugador');
                }
                else
                {
                   return redirect('jugador/nuevo')->with('mensaje','Ese número ya existe en el equipo')->withInput();
                }

            }
            else
            {
                return redirect('jugador/nuevo')->with('mensaje','El equipo ya posee 11 miembros')->withInput();
            }
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
        $jugador = Jugador::find($id);
        /*$persona = DB::table('personas')
                     ->select('personas.id as idpe','ci','nombre','ap_paterno','ap_materno','fecha_nacimiento','email')
                     ->where('personas.id','=',$jugador->persona_id)
                     ->get();*/
        $ju = $jugador->persona_id;
        $persona = Persona::find($ju);
        $equipo = DB::table('equipos')
                     ->select('nombre_equipo','equipos.id as ideq')
                     ->get();
        return view('jugador.edit')->with('datos', array('jugador' => $jugador,
                                                         'persona' =>$persona,
                                                          'equipo' =>$equipo));
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
            );
        $mensajes = array(


            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre solo debe contener letras',
            'ap_paterno.required' => 'El apellido paterno es obligatorio',
            'ap_paterno.string' => 'El apellido solo debe contener caracteres',
            'ap_materno.required' => 'El apellido materno es obligatorio',
            'ap_materno.string' => 'El apellido materno solo debe contener caractres',);


        $errores = $this->validate($request,$reglas,$mensajes);
        if($errores)
        {
            $count = Jugador::where('equipo_id',$request['ideq'])
                            ->count();
            if($count <= 10)
            {
                /*$numerorep = DB::table('jugadores')
                            ->where('equipo_id',$request['ideq'])
                            ->where('numero',$request['numero'])
                            ->get()
                            ->last();*/

                //if(is_null($numerorep))
                //{
                    $persona = Persona::find($request['idpe']);
                    $jugador = Jugador::find($request['idju']);


                    //$persona->ci = $request['ci'];
                    $persona->nombre = $request['nombre'];
                    $persona->ap_paterno = $request['ap_paterno'];
                    $persona->ap_materno = $request['ap_materno'];
                    $persona->fecha_nacimiento = $request['fecha_nacimiento'];
                    $persona->email = $request['email'];
                    //$jugador->numero = $request['numero'];
                    $jugador->equipo_id = $request['ideq'];
                    //$jugador->persona_id = $id;

                    $persona->save();
                    //$jugador->persona_id = $persona->id;
                    $jugador->save();
                    return redirect('jugador');
                /*}
                else
                {
                   return redirect('jugador/nuevo')->with('mensaje','Ese número ya existe en el equipo')->withInput();
                }*/

            }
            else
            {
                return redirect('jugador/nuevo')->with('mensaje','El equipo ya posee 11 miembros')->withInput();
            }
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
        Jugador::destroy($id);
        return redirect('jugador');
    }

}
