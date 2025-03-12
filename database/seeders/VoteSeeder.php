<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrFail();
        $questions = Question::all();

        foreach ($questions as $question) {
            Vote::factory()
                ->count(20)
                ->for($question)
                ->for($user)
                ->create();
        }
    }
}
