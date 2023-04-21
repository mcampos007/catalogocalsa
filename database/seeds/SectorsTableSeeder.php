<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sector::create([
            'name' => 'Productos Calsa'
        ]);
        Sector::create([
            'name' => 'Productos Fiambres'
        ]);
    }
}

