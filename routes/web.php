<?php

use App\Http\Controllers\googleAuthController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes



// protected routes
Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('both.dashboard');
        });
        Route::resource('/tasks', TaskController::class);
        Route::resource('/meeting', MeetingController::class);

});

// Protected Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [googleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('oauth2/callback', [googleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
require __DIR__ . '/auth.php';
