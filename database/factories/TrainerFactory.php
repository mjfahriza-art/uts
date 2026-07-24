<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
{
    protected $model = Trainer::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Trainer',
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}

