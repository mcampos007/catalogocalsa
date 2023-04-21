<?php

use Illuminate\Database\Seeder;
use App\Banco;

class BancoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Banco::create([
            'name' => 'Macro'
        ]);
         Banco::create([
            'name' => 'Galicia'
        ]);
         Banco::create([
            'name' => 'Frances'
        ]);
    }
}
