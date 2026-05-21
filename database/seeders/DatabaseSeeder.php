<?php

namespace Database\Seeders;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mjuhdi',
            'email' => 'mjuhdi@example.com',
        ]);

        Gym::factory(3)->create()->each(function (Gym $gym) {
            Member::factory(5)->create(['gym_id' => $gym->id])->each(function (Member $member) use ($gym) {
                Membership::factory()->create([
                    'member_id' => $member->id,
                    'gym_id' => $gym->id,
                ]);
            });
        });

        // Create a special gym member named Mjuhdi as requested
        Member::factory()->create([
            'gym_id' => Gym::factory()->create()->id,
            'name' => 'Mjuhdi',
            'email' => 'mjuhdi.member@example.com',
        ]);
    }
}
