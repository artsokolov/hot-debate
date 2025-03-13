<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryNotFoundException;
use App\Http\Service\QuestionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function __construct(
        private QuestionService $questionService
    ) {}

    public function list(string $categorySlug): JsonResponse
    {
        try {
            $questions = $this->questionService->listPublished($categorySlug);

            return response()->json($questions);
        } catch (CategoryNotFoundException $e) {
            // TODO: Catch an exception

            return response()->json([
                'message' => "Category with slug '$categorySlug' not found",
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
