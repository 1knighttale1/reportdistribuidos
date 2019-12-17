<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipo;
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$equipo = Equipo::all();
        $equipo = DB::table('delegados')
                    ->join('equipos','equipos.delegado_id','delegados.id')
                    ->join('personas','delegados.persona_id','personas.id')
                    ->select('user', 'persona_id','nombre','ap_paterno','ap_materno','nombre_equipo','color','equipos.id as ideq')
                    ->get();
        return view('equipo.index')->with('equipos',$equipo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $delegado = DB::table('personas')
                     ->join('delegados','delegados.persona_id',
                        'personas.id')
                     ->select('nombre','ap_paterno','ap_materno','delegados.id as idde')
                     ->get();
        return view('equipo.create')->with('delegados',$delegado);
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
            'nombre_equipo' => 'required',
            'color' => 'required',
            );
        $mensajes = array(
            'nombre_equipo.required' => 'El nombre de equipo es obligatorio',
            'color.required' => 'El color es obligatorio',
            );
        $errores = $this->validate($request,$reglas,$mensajes);

        if($errores)
        {
            //$exisdelegado = Equipo::find($request['idde']);
            /*$exisdelegado = DB::table('equipos')
                              ->where('equipos.delegado_id','=',$request['idde'])
                              ->get();*/
            
            $exisdelegado = Equipo::where('delegado_id','=',$request['idde'])->get()->last();

            if(!is_null($exisdelegado))
            {
                return redirect('equipo/nuevo')->with('mensaje','El delegado ya está asociado a un equipo');
            }
            else{
                $equipo = new Equipo;
                $equipo->nombre_equipo = $request['nombre_equipo'];
                $equipo->color = $request['color'];
                $equipo->delegado_id = $request['idde'];
                $equipo->save();
                return redirect('equipo'); 
                
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
        $equipo = Equipo::find($id);
        $delegado = DB::table('personas')
                     ->join('delegados','delegados.persona_id',
                        'personas.id')
                     ->select('nombre','ap_paterno','ap_materno','delegados.id as idde')
                     ->get();
        return view('equipo.edit')->with('datos',array('equipos' => $equipo,
                                                       'delegados' =>$delegado ));

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
            'nombre_equipo' => 'required',
            'color' => 'required',
            );
        $mensajes = array(
            'nombre_equipo.required' => 'El nombre de equipo es obligatorio',
            'color.required' => 'El color es obligatorio',
            );
        $errores = $this->validate($request,$reglas,$mensajes);

        if($errores)
        {
                $equipo = Equipo::find($request['id']);
                $equipo->nombre_equipo = $request['nombre_equipo'];
                $equipo->color = $request['color'];
                $equipo->delegado_id = $request['idde'];
                $equipo->save();
                return redirect('equipo');
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
        Equipo::destroy($id);
        return redirect('equipo');
    }
}
