<?php

namespace Database\Factories;

use App\Models\Trainer;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Membership>
 */
class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'trainer_id' => function (array $attributes) {
                if (isset($attributes['member_id'])) {
                    return Member::find($attributes['member_id'])->trainer_id;
                }

                return Trainer::factory();
            },
'package' => fake()->randomElement(['gold', 'silver', 'bronze']),
            'price' => fake()->randomFloat(2, 150, 1000),
            'status' => fake()->randomElement(['active', 'paused', 'expired']),
            'start_date' => fake()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
