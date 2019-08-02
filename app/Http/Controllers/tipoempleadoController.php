<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoempleado;

class tipoempleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoempleado= Tipoempleado::all();
        return response()->json(['tipoempleado'=>$tipoempleado, 'code'=>'200']) ;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(empty($request->descripcion)) {
            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }
        $tipoempleado = new Tipoempleado();
        $tipoempleado->descripcion=$request->descripcion;
        $tipoempleado->save();
        return response()->json(['message'=>'Tipoempleado creado correctamente', 'code'=>'201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoempleado= Tipoempleado::find($id);
       if((empty($tipoempleado))){
        return response()->json(['message'=>'tipoempleado no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['tipoempleado'=>$tipoempleado, 'code'=>'200']) ;
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
         if(empty($request->descripcion)) {

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }


        $tipoempleado=Tipoempleado::find($id);
        if(empty($tipoempleado)){

                return response()->json(['message'=>'TipoEmpleado no encontrado', 'code'=>'404']);
        }
        
        $tipoempleado->descripcion=$request->descripcion;
        $tipoempleado->save();
        return response()->json(['message'=>'TipoEmpleado actualizado', 'code'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($id)) {

            return response()->json(['message'=>'el id es obligatorio', 'code'=>'406']);
        }


        $tipoempleado=Tipoempleado::find($id);
        if(empty($tipoempleado)){

                return response()->json(['message'=>'tipoempleado no encontrado', 'code'=>'404']);
        }
        
        $tipoempleado->delete();

        return response()->json(['message'=>'tipoempleado borrado', 'code'=>'200']);
    }
}
