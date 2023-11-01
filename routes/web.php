<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UmkmController;

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

// Index Page
Route::get('/', [UserController::class, 'index'])->name('homepage');

// Promo Page
Route::get('/promo', [UserController::class, 'promoLayout']);
Route::get('/promo/makanan', [UserController::class, 'makanan']);
Route::get('/promo/minuman', [UserController::class, 'minuman']);
Route::get('/promo/cemilan', [UserController::class, 'cemilan']);
Route::get('/promo', [UserController::class, 'semua']);

// Detail Routes
Route::get('/detail-warung',[UserController::class,'detailWarung']);
Route::get('/detail-makanan',[UserController::class,'detailMakanan']);

//Pesanan Routes
Route::get('/pesanan',[CartController::class,'index']);
Route::get('/pesanan/status',[CartController::class,'status']);

// Login & Register Routes
Route::get('/masuk', [UserController::class,'login']);
Route::get('/daftar', [UserController::class,'register']);
Route::get('/input-registrasi',[UserController::class,'input_register']);
Route::get('/code-verification',[UserController::class,'code_verification']);
Route::get('atur-ulang-kata-sandi',[UserController::class,'atur_ulang_kata_sandi']);

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'pages/admin/dashboard')->name('dashboard');
    Route::view('/umkm', 'pages/admin/UMKM')->name('umkm');
    Route::post('/umkm', [UmkmController::class, 'storeUmkm'])->name('umkm.store');
});

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
