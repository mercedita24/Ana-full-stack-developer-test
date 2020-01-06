<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TipoVehiculo;
use Validator;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = TipoVehiculo::with('vehiculos')->get();
       
            return response()->json([
                'success' =>  true,
                'tipo' => $tipo,
                ], 200); //status 200
    }

    public function newTipo(Request $request)
    {
        $data = $request->only('nombre');

        $validator = Validator::make($data, [
            'nombre' => 'required'
        ]);
        if($validator-> fails()){
            return response()-> json([
                'success' =>  false,
                'message' => 'Wrong validation',
                'errors' => $validator->errors()
            ]);
        }
        //todo genial
        $tipo = new TipoVehiculo();

        $tipo->nombre = request()->nombre;
        $tipo->save();
        return response()->json([
            'success' =>  true,
            'tipo' => $tipo,
            'message' => 'Tipo de vehiculo creado exitosamente'
            ], 200); //status 200

    }

}
