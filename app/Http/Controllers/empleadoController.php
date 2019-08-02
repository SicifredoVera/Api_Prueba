<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Tipoempleado;
//use App\Tipoempleado;
class empleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado= Empleado::all();
        return response()->json(['empleado'=>$empleado, 'code'=>'200']) ;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(empty($request->nombre) || empty($request->apellido)|| empty($request->cedula)|| empty($request->tipoempleadoid)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }

        $tipo=Tipoempleado::find($request->tipoempleadoid);
        if((empty($tipo))){
    return response()->json(['message'=>'tipoempleado no encontrado en la base de datos', 'code'=>'404']);

        }

        $empleado = new Empleado();
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->cedula=$request->cedula;
        $empleado->tipoempleadoid=$request->tipoempleadoid;
        $empleado->save();
        return response()->json(['message'=>'Empleado creado correctamente', 'code'=>'201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $empleado= Empleado::find($id);
       if((empty($empleado))){
        return response()->json(['message'=>'empleado no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['empleado'=>$empleado, 'code'=>'200']) ;    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(empty($request->nombre) || empty($request->apellido )|| empty($request->cedula) || empty($request->tipoempleadoid)) {

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }

        
        $tipo=Tipoempleado::find($request->tipoempleadoid);
        if((empty($tipo))){
    return response()->json(['message'=>'tipoempleado no encontrado en la base de datos', 'code'=>'404']);
    }

        $empleado=Empleado::find($id);
        if(empty($empleado)){

                return response()->json(['message'=>'Empleado no encontrado', 'code'=>'404']);
        }
        
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->cedula=$request->cedula;
        $empleado->tipoempleadoid=$request->tipoempleadoid;
        $empleado->save();
        return response()->json(['message'=>'Empleado actualizado', 'code'=>'200']);
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


        $empleado=Empleado::find($id);
        if(empty($empleado)){

                return response()->json(['message'=>'empleado no encontrado', 'code'=>'404']);
        }
        
        $empleado->delete();

        return response()->json(['message'=>'empleado borrado', 'code'=>'200']);
    
    }
}
