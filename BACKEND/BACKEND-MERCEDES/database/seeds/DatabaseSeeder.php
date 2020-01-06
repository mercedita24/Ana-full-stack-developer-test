<?php

use Illuminate\Database\Seeder;
use App\Vehiculo;
use App\TipoVehiculo;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Vehiculo::truncate();
        TipoVehiculo::truncate();


        $this->call(UsersTableSeeder::class);
        $this->call(VehiculoTableSeeder::class);
        $this->call(TipoVehiculoSeeder::class);
    }
}
