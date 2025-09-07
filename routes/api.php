<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Chat API
Route::get('/chat/threads', [\App\Http\Controllers\ChatController::class, 'threads']);
Route::post('/chat/open', [\App\Http\Controllers\ChatController::class, 'open']);
Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'send']);
Route::get('/chat/{threadId}/messages', [\App\Http\Controllers\ChatController::class, 'listMessages']);
Route::post('/chat/{threadId}/admin-reply', [\App\Http\Controllers\ChatController::class, 'adminReply']);
Route::get('/chat/unread-count', [\App\Http\Controllers\ChatController::class, 'unreadCount']);
Route::post('/chat/{threadId}/mark-read', [\App\Http\Controllers\ChatController::class, 'markAsRead']);
Route::get('/chat/thread-unread-counts', [\App\Http\Controllers\ChatController::class, 'getThreadUnreadCounts']);
Route::get('/chat/{threadId}/unread-count', [\App\Http\Controllers\ChatController::class, 'getUnreadCountForCustomer']);

// Product Reviews API (chỉ các endpoint không cần session)
Route::get('/products/{productId}/reviews', [\App\Http\Controllers\ProductReviewController::class, 'getProductReviews']);
Route::get('/products/{productId}/reviews/stats', [\App\Http\Controllers\ProductReviewController::class, 'getReviewStats']);
