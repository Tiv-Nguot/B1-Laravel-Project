<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\FriendRequestController;
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
});