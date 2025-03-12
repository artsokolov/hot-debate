<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrFail();
        $questions = Question::all();

        foreach ($questions as $question) {
            Comment::factory()
                ->count(5)
                ->for($question)
                ->for($user)
                ->create();
        }
    }
}
