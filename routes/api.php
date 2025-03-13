<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('sign-up', [AuthController::class, 'signUp']);
    Route::post('sign-in', [AuthController::class, 'signIn']);
});

Route::get('questions/{categorySlug:string}', [QuestionController::class, 'list']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
