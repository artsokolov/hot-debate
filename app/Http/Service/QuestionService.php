<?php

namespace App\Http\Service;

use App\Exceptions\BadQuestionException;
use App\Exceptions\CategoryNotFoundException;
use App\Exceptions\UserNotAllowedException;
use App\Http\DTO\CreateQuestion;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class QuestionService
{
    /**
     * @throws CategoryNotFoundException
     */
    public function listPublished(string $categorySlug): LengthAwarePaginator
    {
        $category = Category::whereSlug($categorySlug)->first();
        if (!$category) {
            throw new CategoryNotFoundException("Category with slug '$categorySlug' not found");
        }

        return $category->questions()->published()->paginate();
    }

    /**
     * @throws CategoryNotFoundException
     * @throws BadQuestionException
     * @throws UserNotAllowedException
     */
    public function askQuestion(CreateQuestion $question): Question
    {
        /** @var Category $category */
        $category = Category::find($question->getCategoryId());
        if (!$category) {
            throw new CategoryNotFoundException("Category with id '{$question->getCategoryId()}' not found");
        }

        $limitExceeded = Question::exceedingLimit($question->getUserId());
        if ($limitExceeded) {
            throw new UserNotAllowedException("You have exceeded the number of questions limit");
        }

        if (!Str::endsWith($question->getQuestion(), '?')) {
            throw new BadQuestionException("Question should end with question mark");
        }

        return $category->questions()
            ->create([
                'title' => $question->getQuestion(),
                'user_id' => $question->getUserId(),
                'is_anonymous' => $question->isStayAnonymous()
            ]);
    }
}
