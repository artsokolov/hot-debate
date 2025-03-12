<?php

namespace Database\Seeders;

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
        $user = User::whereEmail('test@example.com')->first();
        if (!$user) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'test@example.com',
            ]);
        }

        $this->call([
            CategorySeeder::class,
            QuestionSeeder::class,
            VoteSeeder::class,
        ]);
    }
}
