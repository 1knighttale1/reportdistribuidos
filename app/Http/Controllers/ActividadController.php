<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Grupo;
use App\Actividad;
use App\Partido;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id=Crypt::decrypt($id);
        $grupo=Grupo::find($id);
        return view('actividad.index')->with('grupo',$grupo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $id=Crypt::decrypt($id);
        $act=Actividad::find($id);
        return view('actividad.edit')->with('actividad',$act);
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
        $id=Crypt::decrypt($request['id']);
        $act=Actividad::find($id);
        $reglas=array(
          'nombre'=>'required'
        );
        $this->validate($request,$reglas);
        $act->nombre=$request['nombre'];
        $act->fecha_inicio=$request['fecha_inicio'];
        $act->fecha_fin=$request['fecha_fin'];
        $act->save();
        $gid=$act->grupo()->get()->last()->id;
        return redirect('/actividad/'.Crypt::encrypt($gid))->with('estado','la actividad '.$act->nombre.' se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=Crypt::decrypt($request['id']);
        $act=Actividad::find($id);
        $grupo=$act->grupo()->get()->last();
        $ps=$act->partidos()->get();
        foreach($ps as $p){
          $p->delete();
        }
        $act->delete();
        return redirect('/actividad/'.Crypt::encrypt($grupo->id))->with('estado','La actividad se elimino exitosamente!!!');
    }
}
