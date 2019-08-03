<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoempleado;

class tipoempleadoController extends Controller
{
    /**
 * @SWG\Swagger(
 *   basePath="/api/v0",
 *   @SWG\Info(
 *     title="API TIPO_EMPLEADO ISIDRO",
 *     version="1.0.0"
 *   )
 * )
 */

/**
 * @SWG\Get(
 *   path="/tipoempleado",
 *   tags={"Tipo de Empleados"},
 *   summary="Obtener Tipo_Empleado",
 *   operationId="getCustomerRates",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */
    public function index()
    {
        $tipoempleado= Tipoempleado::all();
        return response()->json(['tipoempleado'=>$tipoempleado, 'code'=>'200']) ;
    }

/**
     * @SWG\Post(
     *   path="/tipoempleado",
     *   tags={"Tipo de Empleados"},
     *   summary="Ingresar Tipo_Empleado",
     *   operationId="getCustomerRates2",
     *   @SWG\Parameter(
     *     name="descripcion",
     *     in="formData",
     *     description="Ingrese Tipo_Empleado",
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
         if(empty($request->descripcion)) {
            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }
        $tipoempleado = new Tipoempleado();
        $tipoempleado->descripcion=$request->descripcion;
        $tipoempleado->save();
        return response()->json(['message'=>'Tipoempleado creado correctamente', 'code'=>'201']);
    }

    
/**
     * @SWG\Get(
     *   path="/tipoempleado/{id}",
     *   tags={"Tipo de Empleados"},
     *   summary="Obtener Tipo_Empleado con Id",
     *   operationId="getRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingrese el id de tipoempleado a buscar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="el id de red existe"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Put(
     *   path="/tipoempleado/{id}",
     *   tags={"Tipo de Empleados"},
     *   summary="Actualizar TipoEmpleado",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Ingrese el ID a Modificar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="descripcion",
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
     * @SWG\Delete(
     *   path="/tipoempleado/{id}",
     *   tags={"Tipo de Empleados"},
     *   summary="Eliminar Tipo_Empleado",
     *   operationId="deleteTipoEmpleado",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar el id de tipoempleado a Eliminar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Tipo_Empleado eliminado correctamente"),
     *   @SWG\Response(response=404, description="Tipo_Empleado no encontrado"),
     * )
     *
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
