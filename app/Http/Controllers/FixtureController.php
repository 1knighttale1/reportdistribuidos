<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Fixture;
use App\Grupo;
use App\Actividad;
use App\Partido;
class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f=Fixture::all();
        return view('fixture.index')->with('fixtures',$f);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('fixture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $sv=array("1","2","4","8");
        //dd($request);
        //return ;
        $reglas=array(
          'nombre'=>'required|string|min:3|max:30',
          'series'=>'required|numeric|min:1|max:8|same:'.((in_array($request['series'],$sv))? 'series':-1),
          'numArbitros'=>'required|numeric|min:'.$request['series'],
          'cantPD'=>'required|numeric|min:1',
          'numEquipo'=>'required|numeric|min:'.$request['series']*3
        );
        //dd($request);
        //dd((in_array($request['series'],$sv))? $request['series']:-1);
        //return;
        $msn=array(
          'nombre.min'=>'El nombre es muy corto',
          'nombre.max'=>'El nombre es muy largo',
          'series.min'=>'El numero de series debe ser mayor a 1',
          'series.min'=>'El numero de series debe ser menor a 8',
          'series.same'=>'El numero de series deve ser diferente a '.$request['series'],
          'numArbitros.required'=>'Seleccione algun arbitro',
          'numArbitros.min'=>'Seleccione mas arbitros',
          'cantPD.min'=>'Seleccione las horas en las q se programaran los partidos',
          'numEquipo.min'=>'La cantidad de equipos es insuficiente para la cantidad de series'
        );
        $this->validate($request,$reglas,$msn);
        $fix=new Fixture;
        $fix->nombre=$request['nombre'];
        $fix->estado=0;
        $fix->administrador_id=1;
        $fix->save();
        //  CrearSeries($fix->id,$request['series'],$request['equipos']);
        $grupos=new Grupo;
        $grupos->CrearGrupos($fix->id,$request['series'],$request['equipos'],
                            count($request['horas']),$request['horas'],$request['fecha_inicio'],$request['arbitros']);
        return redirect('/fixture/nuevo')->with('estado','Fixture '.$request['nombre'].' fue creado Exitosamente!!!');
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
    public function rol($id){
      $id=Crypt::decrypt($id);
      $fix=Fixture::find($id);
      return view('fixture.rol')->with('fixture',$fix);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fixture=Fixture::find(Crypt::decrypt($id));
        return view('fixture.edit')->with('fixture',$fixture);
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
      $reglas=array(
        'nombre'=>'required|string|min:3|max:30');
      $this->validate($request,$reglas);
      $fix=Fixture::find($request['id']);
      $fix->nombre=$request['nombre'];
      $fix->save();
      return redirect('fixture')->with('estado','Se altualizo Correctamente!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resultados($id){
      $id=Crypt::decrypt($id);
      $fix=Fixture::find($id);
      return view('fixture.resultados')->with('fixture',$fix);
    }
    public function destroy($id)
    {
        //
        $gs=Fixture::find(Crypt::decrypt($id))->grupos()->get();
        foreach ($gs as $g) {
          $as=$g->actividades()->get();
          foreach ($as as $a) {
            $ps=$a->partidos()->get();
            foreach($ps as $p)
              $p->delete();
            $a->delete();
          }
          $g->delete();
        }
        Fixture::destroy(Crypt::decrypt($id));
        return redirect('fixture')->with('estado','El fixture fue eliminado exitosamente!!!');
    }
}
