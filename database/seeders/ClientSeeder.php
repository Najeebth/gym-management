<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\MembershipPlan;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = MembershipPlan::all();

        // recycle() reuses the already-loaded plans instead of issuing
        // a fresh MembershipPlan query per row (an N+1 inside the seeder itself).
        Client::factory()
            ->recycle($plans)
            ->count(10000)
            ->create();
    }
}
