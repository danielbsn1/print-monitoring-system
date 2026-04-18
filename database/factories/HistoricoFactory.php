<?php

namespace Database\Factories;

use App\Models\Historico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Historico>
 */
class HistoricoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "impressora_id"=> $this->faker->uuid,
            "leitura_id"=> $this->faker->uuid,
        ];
    }
}
