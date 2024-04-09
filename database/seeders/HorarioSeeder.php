<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'horaini' => '06:45:00',
            'horafin' => '08:15:00',
            'estado' => 'disponible',
            'id_ambiente' => '1',
        ]);
    }
}
