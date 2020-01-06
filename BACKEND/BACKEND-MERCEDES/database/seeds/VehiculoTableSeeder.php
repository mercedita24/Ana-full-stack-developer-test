<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class VehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i=1;$i<11;$i++){

        	DB::table('vehiculos')->insert([
            'id' => $i,
            'tipo_vehiculo_id'=>$faker->numberBetween($min = 1, $max = 3),
            'placa' => $faker->numerify('P ######'),
            'tiempo_estacionado' => $i*10,
            'created_at' => date('Y-m-d  H:i:s'),
            'updated_at' => date('Y-m-d  H:i:s')
        	]);

        }
    }
}
