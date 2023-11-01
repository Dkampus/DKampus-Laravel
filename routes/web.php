<?php

use App\Models\Menu;
use App\Models\Data_umkm;
use App\Models\HomeModel;
use App\Models\PromoModel;
use App\Models\DetailWarungModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
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

// Index Page
Route::get('/', function () {
    return view('pages.Users.Homepage', [
        'Banner' => HomeModel::bannerData(),
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'Carousel' => HomeModel::carouselData(),
        'RekomendasiWarung' => Data_umkm::all(),
        'RekomendasiMakanan' => Menu::take(5)->get(), // tampilkan menu yang 5 pertama (tidak semua)
        'Title' => 'Home'
    ]);
})->name('homepage');

// Promo Page
Route::get('/promo', function () {
    return view('layouts.PromoLayout', [
        'Title' => 'Promo',
        'CarouselPromo' => PromoModel::carouselPromo(),
        'NavPromo' => 'Semua'
    ]);
});

Route::get('/promo/makanan', function () {
    return view('pages.Users.MakananPage', [
        'Title' => 'Promo',
        'NavPromo' => 'Makanan',
        'CarouselPromo' => PromoModel::carouselPromo(),
    ]);
});

Route::get('/promo/minuman', function () {
    return view('pages.Users.MinumanPage', [
        'Title' => 'Promo',
        'NavPromo' => 'Minuman',
        'CarouselPromo' => PromoModel::carouselPromo(),
    ]);
});

Route::get('/promo/cemilan', function () {
    return view('pages.Users.CemilanPage', [
        'Title' => 'Promo',
        'NavPromo' => 'Cemilan',
        'CarouselPromo' => PromoModel::carouselPromo(),
    ]);
});

Route::get('/promo', function () {
    return view('pages.Users.SemuaPage', [
        'Title' => 'Promo',
        'NavPromo' => 'Semua',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'CarouselPromo' => PromoModel::carouselPromo(),
    ]);
});

// Detail Routes
Route::get('/detail-warung/{umkm:slug}', function(Data_umkm $umkm){
    return view('pages.Users.DetailWarung',[
        'nama_umkm' => $umkm->nama_umkm,
        'alamat' => $umkm->alamat,
        'rating' => $umkm->rating,
        'CardFood' => $umkm->menu,
        'BannerFade' => DetailWarungModel::bannerDetail(),
        'Title' => 'Detail-Warung'
    ]);
});

Route::get('/detail-makanan/{menu:slug}', function (Menu $menu) {
    return view('pages.Users.DetailMakanan', [
        'Title' => 'Detail-Makanan',
        'umkm_slug' => $menu->data_umkm->slug,
        'nama_makanan' => $menu->nama_makanan,
        'rating' => $menu->rating,
        'harga' => number_format($menu->harga, 0, ',', '.'),
        'deskripsi' => $menu->deskripsi,
        'CardFood' => Menu::where('data_umkm_id', $menu->id)->get(),
    ]);
});

//Pesanan Routes
Route::get('/pesanan', [CartController::class, 'index']);
Route::get('/pesanan/status', [CartController::class, 'status']);

// Login & Register Routes
Route::get('/masuk', [UserController::class, 'login']);
Route::get('/daftar', [UserController::class, 'register']);
Route::get('/input-registrasi', [UserController::class, 'input_register']);
Route::get('/code-verification', [UserController::class, 'code_verification']);
Route::get('atur-ulang-kata-sandi', [UserController::class, 'atur_ulang_kata_sandi']);

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
