<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'price' => 19.99,
                'billing_interval' => 'monthly',
                'duration_days' => 30,
                'short_description' => 'Everything you need to get started.',
                'features' => ['Access to gym floor', 'Free weights & machines', 'Locker room access'],
                'display_order' => 1,
            ],
            [
                'name' => 'Standard',
                'price' => 39.99,
                'billing_interval' => 'monthly',
                'duration_days' => 30,
                'short_description' => 'Our most popular plan.',
                'features' => ['Everything in Basic', 'Unlimited group classes', '1 guest pass per month'],
                'display_order' => 2,
            ],
            [
                'name' => 'Premium',
                'price' => 59.99,
                'billing_interval' => 'monthly',
                'duration_days' => 30,
                'short_description' => 'Full access with personal training.',
                'features' => ['Everything in Standard', '2 personal training sessions/month', 'Priority booking'],
                'display_order' => 3,
            ],
            [
                'name' => 'Annual',
                'price' => 499.99,
                'billing_interval' => 'annual',
                'duration_days' => 365,
                'short_description' => 'Save more with a full year upfront.',
                'features' => ['Everything in Premium', '2 months free vs. monthly Premium'],
                'display_order' => 4,
            ],
        ];

        foreach ($plans as $plan) {
            MembershipPlan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
