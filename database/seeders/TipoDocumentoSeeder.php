<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    private $data = [
        [
            'nombre' => 'RUC',
            'operacion' => 'PERSONA',
        ],
        [
            'nombre' => 'DNI',
            'operacion' => 'PERSONA',
        ],
        [
            'nombre' => 'TICKET',
            'operacion' => 'COMPROBANTE',
        ],
        [
            'nombre' => 'NIC',
            'operacion' => 'PERSONA',
        ],
        [
            'nombre' => 'FACTURA',
            'operacion' => 'COMPROBANTE',
        ],
        [
            'nombre' => 'BOLETA',
            'operacion' => 'COMPROBANTE',
        ],
        [
            'nombre' => 'CEDULA',
            'operacion' => 'PERSONA',
        ],
        [
            'nombre' => 'GUIA-REMISION',
            'operacion' => 'COMPROBANTE',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert($this->data);
    }
}
