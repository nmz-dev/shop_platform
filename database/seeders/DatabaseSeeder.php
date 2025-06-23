<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the necessary roles for system start-up
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'shop_owner']);
        Role::create(['name' => 'customer']);

        // Create fake 10 users
        User::factory(10)->create(); // running database > factories > UserFactory.php
        $users = User::all();

        // Assign random roles to created users
        $users->each(function ($user) {
            $user->assignRole(Role::all()->random(1)->first()->name);
        });
    }
}
