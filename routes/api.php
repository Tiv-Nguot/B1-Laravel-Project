<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\AuthController;
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





Route::get('/comment/list', [CommentController::class, 'index'])->name('comment_list');
Route::post('/comment/create', [CommentController::class, 'store'])->name('comment_create');
Route::get('/comment/show/{id}', [CommentController::class, 'show'])->name('comment_show');
Route::put('/comment/update/{id}', [CommentController::class, 'update'])->name('comment_update');
Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment_delete');
