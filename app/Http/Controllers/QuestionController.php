<?php

namespace App\Http\Controllers;

use App\Exceptions\BadQuestionException;
use App\Exceptions\CategoryNotFoundException;
use App\Http\DTO\CreateQuestion;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Service\QuestionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function __construct(
        private QuestionService $questionService
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
