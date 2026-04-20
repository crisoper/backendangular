<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);
Route::get('posts/{post}/comments', [PostCommentController::class, 'index']);
Route::post('posts/{post}/comments', [PostCommentController::class, 'store']);
