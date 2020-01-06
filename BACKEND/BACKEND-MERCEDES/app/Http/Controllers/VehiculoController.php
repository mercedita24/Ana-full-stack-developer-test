<?php

namespace App\Http\Controllers;
use App\Vehiculo;
use Validator;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{

    public function index()
    {
        return Vehiculo::get()->all();
    }

    public function altaOficial(Request $request)
    {
        $data = $request->only('placa');

        $validator = Validator::make($data, [
            'placa' => 'required|unique:vehiculos', //validando que la placa sea unica y requerida
        ]);
        if($validator-> fails()){
            return response()-> json([
                'success' =>  false,
                'errors' => $validator->errors()
            ]);
        }
        
        $vehiculo = new Vehiculo();
        $vehiculo->tipo_vehiculo_id = 2; //los tipos de vehiculo 2 son Oficiales
        $vehiculo->placa = request()->placa;

        $vehiculo->save();
        return response()->json([
            'success' =>  true,
            'vehiculo' => $vehiculo,
            'message' => 'Vehiculo Oficial añadido exitosamente'
            ], 200); //status 200
    } 

    public function altaResidente(Request $request)
    {
        $data = $request->only('placa');

        $validator = Validator::make($data, [
            'placa' => 'required|unique:vehiculos', //validando que la placa sea unica y requerida
        ]);
        if($validator-> fails()){
            return response()-> json([
                'success' =>  false,
                'errors' => $validator->errors()
            ]);
        }
        
        $vehiculo = new Vehiculo();
        $vehiculo->tipo_vehiculo_id = 1; //los tipos de vehiculo 1 son Residentes
        $vehiculo->placa = request()->placa;

        $vehiculo->save();
        return response()->json([
            'success' =>  true,
            'vehiculo' => $vehiculo,
            'message' => 'Vehiculo Residente añadido exitosamente'
            ], 200); //status 200
    }

}
