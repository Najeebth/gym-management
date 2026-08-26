<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function admin(): User
    {
        $this->seed(RoleSeeder::class);

        return tap(User::factory()->create(), fn (User $user) => $user->assignRole('admin'));
    }

    protected function staff(): User
    {
        $this->seed(RoleSeeder::class);

        return tap(User::factory()->create(), fn (User $user) => $user->assignRole('staff'));
    }
}
