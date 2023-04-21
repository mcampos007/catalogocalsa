<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(EstadochequeTableSeeder::class);
        $this->call(PuntodeventaTableSeeder::class);
        $this->call(BancoTableSeeder::class);
        $this->call(TipomovimientoSeeder::class);
    }
}
