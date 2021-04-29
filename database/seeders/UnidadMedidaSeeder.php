<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadMedidaSeeder extends Seeder
{
    public $data = [
        [
            'nombre' => 'Unidad',
            'prefijo' => 'Und',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Caja',
            'prefijo' => 'Cja',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Paquete',
            'prefijo' => 'Pqt',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Metro',
            'prefijo' => 'Mt',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Docena',
            'prefijo' => 'Doc',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Decena',
            'prefijo' => 'Dec',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Ciento',
            'prefijo' => 'Cto',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Tableta',
            'prefijo' => 'Tab',
            'estado' => 'A',
        ],
        [
            'nombre' => 'Paquete x 10',
            'prefijo' => 'PQ10',
            'estado' => 'A',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidad_medida')->insert($this->data);
    }
}
