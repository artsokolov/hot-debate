<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(): JsonResponse
    {
        return cache()->remember(
            'categories:list',
            now()->addDay(),
            function () {
                return response()->json(Category::all());
            }
        );
    }
}
