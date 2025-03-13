<?php

namespace App\Http\Controllers;

use App\Http\DTO\CreateComment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Service\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService
    ) {}

    public function create(CreateCommentRequest $request, int $questionId): JsonResponse
    {
        $validated = $request->validated();

        $comment = $this->commentService->create(new CreateComment(
            $validated['content'],
            $questionId,
            auth()->id(),
            $validated['parentId'] ?? null
        ));

        return response()->json($comment);
    }
}
