<?php

namespace App\Http\Service;

use App\Exceptions\QuestionNotFoundException;
use App\Exceptions\VotingException;
use App\Models\Question;
use App\Models\Vote;

class VoteService
{
    private function findVote(int $questionId): ?Vote
    {
        return Vote::whereQuestionId($questionId)->first();
    }

    /**
     * @throws QuestionNotFoundException
     * @throws VotingException
     */
    private function vote(int $questionId, int $userId, bool $vote): void
    {
        $question = Question::find($questionId);
        if (!$question) {
            throw new QuestionNotFoundException("Question with id {$questionId} not found during voting");
        }

        if (!$question->openForVoting()) {
            throw new VotingException("You can't vote for this question");
        }

        $existingVote = $this->findVote($questionId);
        if ($existingVote) {
            $existingVote->vote = $vote;
            $existingVote->save();

            return;
        }

        $question->votes()->create([
            'vote' => $vote,
            'user_id' => $userId
        ]);
    }

    /**
     * @throws QuestionNotFoundException
     * @throws VotingException
     */
    public function like(int $questionId, int $userId): void
    {
        $this->vote($questionId, $userId, true);
    }

    /**
     * @throws QuestionNotFoundException
     * @throws VotingException
     */
    public function dislike(int $questionId, int $userId): void
    {
        $this->vote($questionId, $userId, false);
    }
}
