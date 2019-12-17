<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Partido;
use App\Grupo;
use App\Fixture;
class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $act=Actividad::find($id);
        return view('partido.index')->with('actividad',$act);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function partidos_arbitro($id)
    {
      $partidos=DB::table('partidos')->where('arbitro_id',$id)->get();
      return view('partido.partidos_arbitro')->with('partidos',$partidos);
    }
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
        $partido=Partido::find($id);
        return view('partido.edit')->with('partido',$partido);
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
        $partido=Partido::find($id);
        $partido->hora_partido=$request['hora_partido'];
        $partido->arbitro_id=$request['arbitro_id'];
        $partido->save();
        $act_id=$partido->actividad()->get()->last()->id;
        return redirect('/partido/'.$act_id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $act=Partido::find($id)->actividad()->get()->last();
        Partido::destroy($id);
        return redirect('/partido/'.$act->id);
    }
}
