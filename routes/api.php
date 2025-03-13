<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('sign-up', [AuthController::class, 'signUp']);
    Route::post('sign-in', [AuthController::class, 'signIn']);
});

Route::prefix('questions')->middleware('auth:sanctum')->group(function () {
    Route::post('/{questionId}/like', [VoteController::class, 'like']);
    Route::post('/{questionId}/dislike', [VoteController::class, 'dislike']);

    Route::post('/{questionId}/comments', [CommentController::class, 'create']);

    Route::post('/', [QuestionController::class, 'create']);
});

Route::get('categories', [CategoryController::class, 'list']);
Route::get('{categorySlug}/questions', [QuestionController::class, 'list']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
