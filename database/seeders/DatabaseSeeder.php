<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\Redirect;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Link::factory()
            ->count(10)
            ->for($user)
            ->has(Redirect::factory()->count(3))
            ->create();
    }
}
