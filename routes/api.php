<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeAndUnlikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/post/admin/list', [PostController::class, 'adminListPosts']);
    Route::get('/post/user/list', [PostController::class, 'userListPosts']);
    Route::post('/post/create',[PostController::class, 'store']);
    Route::put('/post/admin/update/{id}', [PostController::class, 'adminUpdate']);
    Route::put('/post/user/update/{id}', [PostController::class, 'userUpdate']);
    Route::delete('/post/admin/delete/{id}', [PostController::class, 'adminDestroy']);
    Route::delete('/post/user/delete/{id}', [PostController::class, 'userDestroy']);
    Route::get('/post/show/{id}', [PostController::class, 'show']);
    Route::post('/like/unlike',[LikeAndUnlikeController::class,'store'] );

    Route::get('/comment/list', [CommentController::class, 'index'])->name('comment_list');
    Route::post('/comment/create', [CommentController::class, 'store'])->name('comment_create');
    Route::get('/comment/show/{id}', [CommentController::class, 'show'])->name('comment_show');
    Route::put('/comment/update/{id}', [CommentController::class, 'update'])->name('comment_update');
    Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment_delete');
});
