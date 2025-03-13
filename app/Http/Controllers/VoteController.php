<?php

namespace App\Http\Controllers;

use App\Exceptions\QuestionNotFoundException;
use App\Exceptions\VotingException;
use App\Http\Service\VoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct(
        private readonly VoteService $voteService
    ) {}

    /**
     * @throws QuestionNotFoundException
     * @throws VotingException
     */
    public function like(Request $request, int $questionId): JsonResponse
    {
        $this->voteService->like($questionId, auth()->id());

        return response()->json();
    }

    /**
     * @throws QuestionNotFoundException
     * @throws VotingException
     */
    public function dislike(Request $request, int $questionId): JsonResponse
    {
        $this->voteService->dislike($questionId, auth()->id());

        return response()->json();
    }
}
