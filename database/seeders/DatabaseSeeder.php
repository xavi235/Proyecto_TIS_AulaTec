<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this ->call(RolSeeder::class);
        $this ->call(EstadoSeeder::class);
        $this ->call(UserSeeder::class);
        $this ->call(UbicacionSeeder::class);
        $this ->call(AmbienteSeeder::class);
        $this ->call(HorarioSeeder::class);
    }
}
