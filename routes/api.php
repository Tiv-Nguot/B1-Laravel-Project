<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeAndUnlikeController;
use App\Http\Controllers\Api\PostController;
use App\Models\Role;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\FriendRequestController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/sendOtp', [ForgotPasswordController::class, 'sendOtp']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('add-friend', [FriendRequestController::class, 'addFriendRequest']);
    Route::post('respond-requester', [FriendRequestController::class, 'respondToFriendRequest']);
    Route::get('list-requesters', [FriendRequestController::class, 'listRequesters']);
    Route::get('list-friends', [FriendController::class, 'listFriends']);
    Route::delete('remove-friend', [FriendController::class, 'removeFriend']);

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
   
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);
