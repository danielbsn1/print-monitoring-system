<?php

namespace Database\Factories;

use App\Models\Impressora;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Impressora>
 */
class ImpressoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nome" => Str::of('Impressora 248')->trim(),
            "modelo" => Str::of('Modelo Konica')->trim(),
            "serie" => Str::of('V1')->trim(),
            "ip" => Hash::of('192.168.250.248')->trim(),
        ];
        [
            "nome" => Str::of('Impressora 212')->trim(),
            "modelo" => Str::of('Modelo Konica')->trim(),
            "serie" => Str::of('V4')->trim(),
            "ip" => Hash::of('192.168.250.212')->trim(),
        ];
        [
            "nome" => Str::of('Impressora C600versalink')->trim(),
            "modelo" => Str::of('Modelo Konica')->trim(),
            "serie" => Str::of('V4')->trim(),
            "ip" => Hash::of('192.168.250.223 ')->trim(),  
        ];
    }


    public function configure(): static
    {
        return $this ->state(function (Impressora $impressora) {
            return [
                "nome" => Str::of('Impressora 248')->trim(),
                "modelo" => Str::of('Modelo Konica')->trim(),
                "serie" => Str::of('V1')->trim(),
                "ip" => Hash::of('192.168.250.248')->trim(),
            ];
            [
                "nome" => Str::of('Impressora 212')->trim(),
                "modelo" => Str::of('Modelo Konica')->trim(),
                "serie" => Str::of('V4')->trim(),
                "ip" => Hash::of('192.168.250.212')->trim(),
            ];
            [
                "nome" => Str::of('Impressora C600versalink')->trim(),
                "modelo" => Str::of('Modelo Konica')->trim(),
                "serie" => Str::of('V4')->trim(),
                "ip" => Hash::of('192.168.250.223 ')->trim(),  
            ];
        });
    }
}
