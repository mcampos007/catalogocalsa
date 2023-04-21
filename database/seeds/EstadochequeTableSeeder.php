<?php

use Illuminate\Database\Seeder;
use App\Estadocheque;

class EstadochequeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Estadocheque::create([
            'status' => '1'
        ]); //En cartera

        Estadocheque::create([
            'status' => '2'
        ]); // 2 Depositado

        Estadocheque::create([
            'status' => '3'
        ]); // 3 Pago a Tercero

        Estadocheque::create([
            'status' => '4'
        ]); // 4 Rechazado

        Estadocheque::create([
            'status' => '5'
        ]);// 5 Cambiado/Cobrado en Efectivo
    }
}
