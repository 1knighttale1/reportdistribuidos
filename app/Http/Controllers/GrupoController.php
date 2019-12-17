<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Fixture;
use App\Grupo;
class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fixt=Fixture::find($id);
        return view('grupo.index')->with('fixture',$fixt);
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
        $grupo=Grupo::find($id);
        return view('grupo.edit')->with('grupo',$grupo);
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
      $grupo=Grupo::find($id);
      $grupo->nombre=$request['nombre'];
      $grupo->save();
      return redirect('/grupo/'.$grupo->fixture()->get()->last()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $fix=Grupo::find($id)->fixture()->get()->last();
        $acts=Grupo::find($id)->actividades()->get();
        foreach($acts as $act){
          $ps=$act->partidos()->get();
          foreach($ps as $p){
            $p->delete();
          }
          $act->delete();
        }
        Grupo::destroy($id);
        return redirect('/grupo/'.$fix->id);
    }
}
