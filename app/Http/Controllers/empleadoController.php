<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Tipoempleado;
//use App\Tipoempleado;
class empleadoController extends Controller
{
      

/**
 * @SWG\Get(
 *   path="/empleado",
 *   tags={"Empleados"},
 *   summary="Obtener Empleado",
 *   operationId="getCustomerRates",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */



    public function index()
    {
        $empleado= Empleado::all();
        return response()->json(['empleado'=>$empleado, 'code'=>'200']) ;
    }

    
/**
     * @SWG\Post(
     *   path="/empleado",
     *   tags={"Empleados"},
     *   summary="Ingresar Empleado",
     *   operationId="getCustomerRates1",
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="Ingrese nombre Empleado",
     *     required=true,
     *     type="string"
     *     ),
     *     @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="Ingrese apellido Empleado",
     *     required=true,
     *     type="string"
     *     ),
     *     @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="Ingrese cedula Empleado",
     *     required=true,
     *     type="string"
     *     ),
     *     @SWG\Parameter(
     *     name="tipoempleadoid",
     *     in="formData",
     *     description="Ingrese id Tipo_Empleado",
     *     required=true,
     *     type="string"
     *     ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),)
     * )
     *
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
     * @SWG\Get(
     *   path="/empleado/{id}",
     *   tags={"Empleados"},
     *   summary="Obtener Empleado con Id",
     *   operationId="getRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingrese el id de empleado a buscar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="el id de empleado no existe"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
     */
    public function show($id)
    {
         $empleado= Empleado::find($id);
       if((empty($empleado))){
        return response()->json(['message'=>'empleado no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['empleado'=>$empleado, 'code'=>'200']) ;    }

    

    /**
     * @SWG\Put(
     *   path="/empleado/{id}",
     *   tags={"Empleados"},
     *   summary="Actualizar Empleado",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingrese el ID a Modificar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="ingresar nombre empleado",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="ingresar apellido empleado",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="ingresar cedula empleado",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="tipoempleadoid",
     *     in="formData",
     *     description="ingresar el tipo empleado",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="usuario no encontrado"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Delete(
     *   path="/empleado/{id}",
     *   tags={"Empleados"},
     *   summary="Eliminar Empleado",
     *   operationId="delete Empleado",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingresar el id de empleado a Eliminar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Empleado eliminado correctamente"),
     *   @SWG\Response(response=404, description="Empleado no encontrado"),
     * )
     *
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
