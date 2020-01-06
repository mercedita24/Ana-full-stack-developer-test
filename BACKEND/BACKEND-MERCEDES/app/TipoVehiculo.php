<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class TipoVehiculo extends MongoModel
{
    protected $fillable = [
        'nombre'
    ];

    public function vehiculos()
	{
		return $this->hasMany(\App\Vehiculo::class);
	}
}
