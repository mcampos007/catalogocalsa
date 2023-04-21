<?php

use Illuminate\Database\Seeder;
use App\Puntodeventa;

class PuntodeventaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Puntodeventa::create([
            'name' => 'Calsa Salon Zuviria'
        ]); //

        Puntodeventa::create([
            'name' => 'Calsa Salon Delicatessen'
        ]); //
        Puntodeventa::create([
                'name' => 'Calsa Salon Independencia'
            ]); //
        Puntodeventa::create([
                'name' => 'Calsa Salon Santa Fe'
            ]); //
        Puntodeventa::create([
                'name' => 'Calsa Salon San Martin'
            ]); //
        Puntodeventa::create([
                'name' => 'Calsa Salon San Pedro'
            ]); //
        Puntodeventa::create([
                'name' => 'JM Salon CM1'
            ]); //
        Puntodeventa::create([
                'name' => 'JM Salon CM2'
            ]); //
        Puntodeventa::create([
                'name' => 'JM Salon Zuviria'
            ]); //
    }

    
}
