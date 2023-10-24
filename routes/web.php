<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('homepage');
Route::get('/promo', [UserController::class, 'promo']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Route
Route::middleware(['auth', 'UserAccess:user,admin,courier'])->group(function () {
    Route::name('.user')->group(function () {
        // insert route here
        Route::get('/uhuy', function () {
            return view("uhuy");
        });
    });
});

// Admin Route
Route::middleware(['auth', 'UserAccess:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('.admin')->group(function () {
            // insert route here
        });
    });
});

// Courier Route
Route::middleware(['auth', 'UserAccess:courier,admin'])->group(function () {
    Route::prefix('courier')->group(function () {
        Route::name('.courier')->group(function () {
            // insert route here
        });
    });
});


require __DIR__ . '/auth.php';
