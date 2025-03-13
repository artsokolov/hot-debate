<?php

namespace Database\Seeders;

use App\Models\ModerationLog;
use App\Models\ModerationReason;
use App\Models\Question;
use App\Models\User;
use App\Models\ValueObject\QuestionStatus;
use Illuminate\Database\Seeder;

class ModerationLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moderator = User::firstOrFail();
        $questions = Question::whereIn('status', [
            QuestionStatus::CLOSED,
            QuestionStatus::REJECTED
        ])->get();
        $reasons = ModerationReason::all();

        foreach ($questions as $question) {
            ModerationLog::factory()
                ->for($question)
                ->for($reasons->random(), 'reason')
                ->for($moderator, 'moderator')
                ->create([
                    'previous_status' => QuestionStatus::ON_MODERATION,
                    'new_status' => $question->status,
                ]);
        }
    }
}
