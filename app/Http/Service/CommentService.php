<?php

namespace App\Http\Service;

use App\Exceptions\CommentCreationException;
use App\Exceptions\QuestionNotFoundException;
use App\Http\DTO\CreateComment;
use App\Models\Comment;
use App\Models\Question;

class CommentService
{
    /**
     * @throws QuestionNotFoundException
     * @throws CommentCreationException
     */
    public function create(CreateComment $comment): Comment
    {
        $question = Question::find($comment->getQuestionId());
        if (!$question) {
            throw new QuestionNotFoundException("Question not found during comment creation");
        }

        if (!$question->isPublic()) {
            throw new CommentCreationException("Question is not public");
        }

        if ($comment->getParentId()) {
            $parent = Comment::find($comment->getParentId())->exists();
            if (!$parent) {
                throw new CommentCreationException("Parent not found. Id: {$comment->getParentId()}");
            }
        }

        return $question->comments()->create([
            'content' => $comment->getContent(),
            'user_id' => $comment->getUserId(),
            'parent_id' => $comment->getParentId()
        ]);
    }
}
