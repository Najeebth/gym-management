<?php

namespace Database\Seeders;

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
        // Local-only fallback admin for fresh `db:seed` runs. For a real admin
        // account, run `php artisan admin:create-or-update {email}` instead so the
        // password never passes through generated code.
        $localAdmin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Local Admin', 'password' => bcrypt('password')],
        );

        $this->call([
            RoleSeeder::class,
            MembershipPlanSeeder::class,
            ClientSeeder::class,
            WebsiteCmsSeeder::class,
        ]);

        $localAdmin->assignRole('admin');
    }
}
