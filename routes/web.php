<?php

use App\Models\Menu;
use App\Models\Footer;
use App\Models\Data_umkm;
use App\Models\HomeModel;
use App\Models\PromoModel;
use App\Models\DetailWarungModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UntukKamuController;

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
        'CarouselDesktop' => HomeModel::carouselDesktopData(),
        'RekomendasiWarung' => Data_umkm::all(),
        'RekomendasiMakanan' => Menu::take(5)->get(), // tampilkan menu yang 5 pertama (tidak semua)
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
        'Title' => 'Home',
    ]);
})->name('homepage');
// Route::get('/', [UntukKamuController::class, 'UntukKamu']);

// Settings Routes
// todo here .... ? - daftar alamat, ubah kata sandi, bersihkan cache, tentang kami, syarat dan ketentuan, beri kami ulasan

// Daftar Alamat
Route::get('/daftar-alamat', function () {
    return view('pages.Users.DaftarAlamat', [
        'Title' => 'Daftar Alamat',
    ]);
});

// Ubah Kata Sandi
Route::get('/change-password', function () {
    return view('pages.Users.UbahKataSandi', [
        'Title' => 'Ubah Kata Sandi',
    ]);
});

// Chats Routes

// Chat page
Route::get('/chats', function () {
    return view('pages.Users.ChatPage', [
        'Title' => 'Chat',
    ]);
});

// Chat Rooms (require unique id)
Route::get('/chats/{id}', function ($id) {
    return view('pages.Users.ChatRoomPage', [
        'Title' => 'Chat Room',
        'id' => $id,
    ]);
});


// Promo Page
Route::get('/promo', function () {
    return view('layouts.PromoLayout', [
        'Title' => 'Promo',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'NavPromo' => 'Semua',
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo/makanan', function () {
    return view('pages.Users.MakananPage', [
        'Title' => 'Promo',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Makanan',
        'PromoMakananSlider' => PromoModel::promoMakanan(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo/minuman', function () {
    return view('pages.Users.MinumanPage', [
        'Title' => 'Promo',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Minuman',
        'PromoMinumanSlider' => PromoModel::promoMakanan(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo/cemilan', function () {
    return view('pages.Users.CemilanPage', [
        'Title' => 'Promo',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Cemilan',
        'PromoCemilanSlider' => PromoModel::promoMakanan(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo', function () {
    return view('pages.Users.SemuaPage', [
        'Title' => 'Promo',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Semua',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

// Detail Routes
Route::get('/detail-warung/{umkm:id}', function(Data_umkm $umkm){
    return view('pages.Users.DetailWarung',[
        'nama_umkm' => $umkm->nama_umkm,
        'alamat' => $umkm->alamat,
        'rating' => $umkm->rating,
        'CardFood' => $umkm->menu,
        'BannerFade' => DetailWarungModel::bannerDetail(),
        'Title' => 'Detail-Warung',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
    ]);
});

Route::get('/detail-makanan/{menu:nama_makanan}', function (Menu $menu) {
    return view('pages.Users.DetailMakanan', [
        'Title' => 'Detail-Makanan',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'menu_id' => $menu->id,
        'umkm_slug' => $menu->data_umkm->id,
        'nama_makanan' => $menu->nama_makanan,
        'rating' => $menu->rating,
        'harga' => number_format($menu->harga, 0, ',', '.'),
        'deskripsi' => $menu->deskripsi,
        'CardFood' => Menu::where('data_umkm_id', $menu->data_umkm_id)->get(),
    ]);
})->name('detail-makanan');

//Pesanan Routes
Route::post('/pesananStore', [CartController::class, 'store']);
Route::get('/pesanan/status', [CartController::class, 'status']);
Route::delete('/pesanan/delete', [CartController::class, 'destroy'])->name('cart.delete');
Route::patch("/pesanan/update-quantity", [CartController::class, 'updateQuantity']);


//Favorite Routes
Route::get('/favorit',function(){
    return view('pages.Users.Favorit',[
        'Title' => 'Favorit',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'RekomendasiWarung' => Data_umkm::all(),
        'RekomendasiMakanan' => Menu::take(5)->get(),
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
    ]);
});

//Favorite Routes
//Route::get('/favorit', function () {
//    return view('pages.Users.FavoritPage', [
//        'Title' => 'Favorit',
//        'CardFood' => Menu::all(),
//    ]);
//});

// Login & Register Routes
Route::get('/masuk', [UserController::class, 'login']);
Route::get('/daftar', [UserController::class, 'register']);
Route::get('/input-registrasi', [UserController::class, 'input_register']);
Route::get('/code-verification', [UserController::class, 'code_verification']);
Route::get('/atur-ulang-kata-sandi', [UserController::class, 'atur_ulang_kata_sandi']);


// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'pages/admin/dashboard', [
        'data_umkm' => Data_umkm::all(),
    ]
    )->name('dashboard');
    Route::view('/umkm', 'pages/admin/UMKM')->name('umkm');
    Route::post('/umkm', [UmkmController::class, 'storeUmkm'])->name('umkm.store');
    Route::get('/product', function() {
        return view('pages/admin/product_form', [
            'model' => new Menu(),
            'umkm' => Data_umkm::pluck('nama_umkm', 'id'),
            'button' => 'SIMPAN',
            'route' => "product.store",
            'method' => 'POST'
        ]);
    })->name('product');
    Route::post('/product', [MenuController::class, 'store'])->name('product.store');


    // edit & delete product route
    //to edit product form
    Route::get('/product/{menu}/edit', function(Menu $menu) {
        return view('pages/admin/product_form', [
            'model' => $menu,
            'umkm' => Data_umkm::pluck('nama_umkm', 'id'),
            'button' => 'UPDATE',
            'route' => ['product.update', $menu->id],
            'method' => 'PUT'
        ]);
    })->name('product.edit');
    //data from edit product form
    Route::put('/product/{menu}', [MenuController::class, 'update'])->name('product.update');
    //delete product
    Route::delete('/product/{menu}', [MenuController::class, 'destroy'])->name('product.destroy');

    // edit & delete umkm route
    //to edit umkm form
    Route::get('/umkm/{umkm}/edit', function(Data_umkm $umkm) {
        return view('pages/admin/umkm_update', [
            'umkm' => $umkm,
            'products' => Menu::where('data_umkm_id', $umkm->id)->get(),
        ]);
    })->name('umkm.edit');
    //data from edit umkm form
    Route::put('/umkm/{umkm}', [UmkmController::class, 'update'])->name('umkm.update');
    //delete umkm
    Route::delete('/umkm/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pesanan', [CartController::class, 'index']);
Route::post('/favoritStore/{menuId}', [FavoritController::class, 'favoritStore'])->name('favorite.add');
Route::get('/search', [MenuController::class, 'search'])->name('search');

// User Route
Route::middleware(['auth', 'UserAccess:user,admin,courier'])->group(function () {
    Route::name('user.')->group(function () {
        // insert route here
        Route::get('/uhuy', function () {
            return view("uhuy");
        });

        // seacrh makanan using nicolaslopezj/searchable keyword

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
