<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Persona::all();
        return view("persona.index")->with('personas',$p);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $per=new Persona;
            $per->ci=$request['ci'];
            $per->nombre=$request['nombre'];
            $per->ap_paterno=$request['ap_paterno'];
            $per->ap_materno=$request['ap_materno'];
            $per->fecha_nacimiento=$request['fecha_nacimiento'];
            $per->email=$request['email'];
            $per->save();
            return redirect('persona');
           
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
        $persona = Persona::find($id);
        return view('persona.edit')->with('persona',$persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        /*
            $reglas=array(
              'nombre'=>'required|string|min:3|max:30',
              'ap_paterno'=>'required|string|min:4|max:15',
              'ap_materno'=>'required|string|min:4|max:15',
              'fecha_nacimiento'=>'required|date',
             ); 
           $mensaje = array(
            'nombre.required' => 'El campo Nombre es necesario llenarlo',
            'ap_materno.required' => 'El campo Apellido Materno es necesario llenarlo',);
           $this->validate($request,$reglas,$mensaje);
           */
           //dd($request);
            $per = Persona::find($request['id']);
            $per->nombre=$request->input('nombre');
            $per->ap_paterno=$request->input('ap_paterno');
            $per->ap_materno=$request->input('ap_materno');
            $per->fecha_nacimiento=$request->input('fecha_nacimiento');
            $per->save();
            return redirect('persona');
            
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);
        return redirect('persona');
    }
}
