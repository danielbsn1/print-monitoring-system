<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImpressoraSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("impressoras")->delete();
        DB::table("impressoras")->insert([
            [
                'nome' => 'Impressora 248',
                'modelo' => 'Modelo Konica',
                'serie' => 'V1',
                'ip' => '192.168.250.248',
            ],
            [
                'nome' => 'Impressora 212',
                'modelo' => 'Modelo Konica',
                'serie' => 'V4',
                'ip' => '192.168.250.212',
            ],
            [
                'nome' => 'Impressora 223',
                'modelo' => 'Modelo Konica',
                'serie' => 'V4',
                'ip' => '192.168.250.223',
            ],
        ]);
    }
}