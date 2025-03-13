<?php

namespace App\Http\Controllers;

use App\Exceptions\BadQuestionException;
use App\Exceptions\CategoryNotFoundException;
use App\Exceptions\UserNotAllowedException;
use App\Http\DTO\CreateQuestion;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Service\QuestionService;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    public function __construct(
        private readonly QuestionService $questionService
    ) {}

    /**
     * @throws CategoryNotFoundException
     */
    public function list(string $categorySlug): JsonResponse
    {
        $questions = $this->questionService->listPublished($categorySlug);

        return response()->json($questions);
    }

    /**
     * @throws CategoryNotFoundException
     * @throws BadQuestionException
     * @throws UserNotAllowedException
     */
    public function create(CreateQuestionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $question = $this->questionService->askQuestion(new CreateQuestion(
            $validated['question'],
            $validated['categoryId'],
            $validated['stayAnonymous'],
            auth()->id()
        ));

        return response()->json($question);
    }
}
