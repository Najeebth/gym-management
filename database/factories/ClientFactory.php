<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\MembershipPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $joinDate = fake()->dateTimeBetween('-3 years', 'now');

        return [
            // recycle(MembershipPlan::all()) in the seeder avoids re-querying per row;
            // this fallback only runs when the factory is used standalone (e.g. tests).
            'membership_plan_id' => MembershipPlan::factory(),
            'created_by' => null,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('##########'),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-16 years'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'join_date' => $joinDate,
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'frozen', 'cancelled']),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->numerify('##########'),
            'notes' => fake()->boolean(20) ? fake()->sentence() : null,
        ];
    }
}
