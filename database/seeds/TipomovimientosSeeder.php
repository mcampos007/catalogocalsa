<?php

use Illuminate\Database\Seeder;
use App\Tipomovimiento;

class TipomovimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipomovimiento::create([
            'name' => 'Transferencia'
        ]);
        Tipomovimiento::create([
            'name' => 'Retencion IB'
        ]);
        Tipomovimiento::create([
            'name' => 'Retencion Ganancias'
        ]);
    }
}
