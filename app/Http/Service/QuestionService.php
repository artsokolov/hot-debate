<?php

namespace App\Http\Service;

use App\Exceptions\CategoryNotFoundException;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionService
{
    /**
     * @throws CategoryNotFoundException
     */
    public function listPublished(string $categorySlug): LengthAwarePaginator
    {
        $category = Category::whereSlug($categorySlug)->first();
        if (!$category) {
            throw new CategoryNotFoundException();
        }

        return $category->questions()->paginate();
    }
}
