<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\EstanciaVehiculo;
use App\Vehiculo;
use Carbon\Carbon;
use Validator;

class EstanciaController extends Controller
{
    public function registrarEntrada(Request $request)
    {

        $data = $request->only('placa');
        //validando que se ingrese el campo requerido
        $validator = Validator::make($data, [
            'placa' => 'required'
        ]);
        if($validator->fails()){ // mensaje de validacion por si no ingresa el campo requerido
            return response()-> json([
                'success' =>  false,
                'message' => 'Wrong validation',
                'errors' => $validator->errors()
            ],404);
        }

        //todo genial
        $vehiculo = Vehiculo::where('placa', $request->placa)->first(); //buscando el vehiculo con la placa ingresada
        if($vehiculo){ //si existe el vehiculo se crea la estancia con la hora de entrada
            $estanciaVehiculo = new estanciaVehiculo();
            $estanciaVehiculo->vehiculo_id = $vehiculo->id;
            $estanciaVehiculo->user_id = auth()->user()->id;
            $estanciaVehiculo->entrada = $this->fecha();
            $estanciaVehiculo->save();
            return response()->json([
                'success' =>  true,
                'entrada-vehiculo' => $estanciaVehiculo,
                'message' => 'Entrada de vehiculo registrada exitosamente'
                ], 200); //status 200
        }
        return response()->json([
            'success' =>  false,
            'entrada-vehiculo' => null,
            'errors' => 'vehiculo no encontrado'
            ], 404); //status 404
    }


    public function registrarSalida(Request $request)
    {
	
        $data = $request->only('placa');

        $validator = Validator::make($data, [
            'placa' => 'required'
        ]);
        if($validator-> fails()){
            return response()-> json([
                'success' =>  false,
                'message' => 'Wrong validation',
                'errors' => $validator->errors()
            ],404);
        }
        //todo genial
        
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();
        if($vehiculo){
            $estanciaVehiculo = EstanciaVehiculo::where('vehiculo_id', $vehiculo->id)->get()->last();
            $estanciaVehiculo->vehiculo_id = $vehiculo->id;
            $estanciaVehiculo->user_id = auth()->user()->id;
            $estanciaVehiculo->salida = $this->fecha();
            switch ($vehiculo->tipo_vehiculo_id) {
                case 1: //El vehiculo es de tipo Residente
                    $estancias = EstanciaVehiculo::where('vehiculo_id', $vehiculo->id)->get();
                     
                    $vehiculo->tiempo_estacionado +=  $this->duracion($estanciaVehiculo->entrada, $estanciaVehiculo->salida);
                    $vehiculo->update();
                    $estanciaVehiculo->importe = $vehiculo->tiempo_estacionado*0.05;
                    $mensaje = "lleva acumulados ".$vehiculo->tiempo_estacionado." minutos equivale a $".$estanciaVehiculo->importe;

                    break;
                    case 2: //El vehiculo es de tipo Oficial
                        $estanciaVehiculo->importe = 0;
                    $mensaje = "el vehiculo entro: ".$estanciaVehiculo->entrada." y salio a las ". $estanciaVehiculo->salida;
                    break;
                    default: //El vehiculo es de tipo No Residente
                    $estanciaVehiculo->importe = ($this->duracion($estanciaVehiculo->entrada, $estanciaVehiculo->salida))*0.5;
                    $mensaje = "El importe es de $".$estanciaVehiculo->importe." gracias por su visita";
            }

            $estanciaVehiculo->save();
            return response()->json([
                'success' =>  true,
                'salida-vehiculo' => $estanciaVehiculo,
                'message' => $mensaje
                ], 200); //status 200
        }
        return response()->json([
            'success' =>  false,
            'entrada-vehiculo' => null,
            'errors' => 'vehiculo no encontrado'
            ], 404); //status 404
    }

    public function comenzarMes()
    {
        //consulta para obtener instancias de vehiculos oficiales
        $estanciasVehiculosOficiales = EstanciaVehiculo::with('vehiculos')->get()->where('vehiculos.tipo_vehiculo_id',2);

        foreach($estanciasVehiculosOficiales as $estancia){
            $estancia->delete(); //eliminando estancias de vehiculos oficiales
        }
        //consulta para obtener los vehiculos residenciales que tienen tiempo estacionado mayor que cero
        $vehiculosRes = Vehiculo::where('tipo_vehiculo_id',1)->where('tiempo_estacionado','>',0)->get();

        foreach($vehiculosRes as $vehiculo){
            $vehiculo->tiempo_estacionado=0; // poniendo a cero el contador de tiempo de vehiculos residenciales
            $vehiculo->update(); 
        }
            
        return response()->json([
            'success' =>  true,
            'comienza mes' => 'mes iniciado',
            'message' => 'estancias de vehiculos oficiales borrados y  estancias de vehiculos residenciales puestos en cero exitosamente'
            ], 200); //status 200        
        }


    public function informePagos()
    {
        $vehiculos = Vehiculo::Where('tipo_vehiculo_id',1)->get(); // consulta de vehiculos residentes 
        if($vehiculos){ // si hay vehiculos residentes
            $data = null;

            foreach($vehiculos as $vehiculo){
                $data[]= ['placa' =>$vehiculo->placa,
                        'tiempo_estacionado' =>$vehiculo->tiempo_estacionado,
                        'pago' =>$vehiculo->tiempo_estacionado*0.05]; // calculo del pago 

            }
                
            return response()->json([
                'success' =>  true,
                'data' => $data,
                'message' => 'Informe de pagos de Residentes'
                ], 200); //status 200        
            }
        // Si no hay vehiculos residentes
        return response()->json([
            'success' =>  false,
            'data' => $data,
            'message' => 'No hay vehiculos residentes registrados'
            ], 404); //status 404        
        }


        /***************  Funciones auxiliares  ***************** */

        public function fecha(){ //funcion retorna el valor de la fecha y hora actual
            return Carbon::now()->toDateTimeString();
        }

        public function duracion($inicio ,$fin){ // retorna el intervalo de tiempo en minutos
            return Carbon::parse($inicio)->diffInMinutes($fin);
        }
    }
    



