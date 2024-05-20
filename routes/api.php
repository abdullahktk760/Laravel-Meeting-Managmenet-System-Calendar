<?php

use App\Http\Controllers\api\PasswordResetController;
use App\Http\Controllers\api\UserController;
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

// Protected routes Sanctum authentication with versioning v1 and future we can add more versions like v2, v3, etc.
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/get/user', [UserController::class, 'gettingUserWithPagnition']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/logout', [UserController::class, 'logout']);
});


// Public routes 10 requests per minute use rate limiter
Route::middleware('throttle:10,1')->group(function () {
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/send-password-reset/email', [PasswordResetController::class, 'sendResetPasswordEmail'])->name('password-reset');

});
