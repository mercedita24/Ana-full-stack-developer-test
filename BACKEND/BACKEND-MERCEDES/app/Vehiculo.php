<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Vehiculo extends MongoModel
{
    protected $fillable = [
        'placa','tipo_vehiculo_id'
    ];

    public function tipo_vehiculo()
	{
		return $this->belongsTo(\App\TipoVehiculo::class, 'tipo_vehiculo_id');
    }
    
    public function estancia_vehiculo()
	{
		return $this->hasMany(\App\EstanciaVehiculo::class, 'estancia_vehiculo_id');
	}
}
