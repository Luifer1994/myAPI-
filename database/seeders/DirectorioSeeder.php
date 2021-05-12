<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directorios')->insert([
            [
                'nombre' => 'Saul',
                'direccion'=>'Direccion 1',
                'telefono' => 312457,
                'foto'=> null,
            ],
            [
                'nombre' => 'Luis A',
                'direccion'=>'Direccion 2',
                'telefono' => 312756,
                'foto'=> null,
            ],
            [
                'nombre' => 'Jesus M',
                'direccion'=>'Direccion 3',
                'telefono' => 312755,
                'foto'=> null,
            ]
        ]);
    }
}
