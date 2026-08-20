<?php

namespace Database\Factories;

use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MembershipPlan>
 */
class MembershipPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'price' => fake()->randomFloat(2, 15, 150),
            'billing_interval' => fake()->randomElement(['monthly', 'quarterly', 'annual', 'one_time']),
            'duration_days' => fake()->randomElement([30, 90, 365, null]),
            'is_active' => true,
        ];
    }
}
