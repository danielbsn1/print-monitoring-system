<?php

namespace Database\Factories;

use App\Models\Leitura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Leitura>
 */
class LeituraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'impressora_id' => $this->faker->uuid,
            'contador' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
