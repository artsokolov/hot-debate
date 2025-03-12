<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrFail();
        $categories = Category::all();

        foreach ($categories as $category) {
            Question::factory()
                ->count(10)
                ->for($category)
                ->for($user)
                ->create();
        }
    }
}
