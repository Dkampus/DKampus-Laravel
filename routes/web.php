<?php

use App\Models\Menu;
use App\Models\User;
use App\Models\Footer;
use App\Models\Data_umkm;
use App\Models\HomeModel;
use App\Models\PromoModel;
use App\Models\DetailWarungModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', [UntukKamuController::class, 'UntukKamu']);

// Settings Routes
// todo here .... ? - daftar alamat, ubah kata sandi, bersihkan cache, tentang kami, syarat dan ketentuan, beri kami ulasan

// Category Menu Page
Route::get('/kategori/{value}', function ($value) {
    try {
        $umkm = Data_umkm::where('id', Menu::where('category', $value)->first()->data_umkm_id)->first();
    } catch (\Throwable $th) {
        $umkm = 'no_data';
    }
    return view('pages.Users.KategoriMenu', [
        'Title' => 'Kategori ' . $value,
        'Kategori' => $value,
        'menus' => Menu::where('category', $value)->get(),
        'umkm' => $umkm,
    ]);
});

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
Route::get('/detail-warung/{umkm:nama_umkm}', function (Data_umkm $umkm) {
    return view('pages.Users.DetailWarung', [
        'nama_umkm' => $umkm->nama_umkm,
        'alamat' => $umkm->alamat,
        'rating' => $umkm->rating,
        'CardFood' => $umkm->menu,
        'umkm_img' => $umkm->logo_umkm,
        'BannerFade' => DetailWarungModel::bannerDetail(),
        'Title' => 'Detail-Warung',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
    ]);
});

// Menu Controller
Route::post('/detail-makanan/{id}', [MenuController::class, 'simpan']);

Route::get('/detail-makanan/{menu:nama_makanan}', function (Menu $menu) {
    return view('pages.Users.DetailMakanan', [
        'Title' => 'Detail-Makanan',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'menu_id' => $menu->id,
        'images' => $menu->image,
        'umkm_slug' => $menu->data_umkm->id,
        'nama_makanan' => $menu->nama_makanan,
        'rating' => $menu->rating,
        'harga' => number_format($menu->harga, 0, ',', '.'),
        'deskripsi' => $menu->deskripsi,
        'CardFood' => Menu::where('data_umkm_id', $menu->data_umkm_id)->get(),
    ]);
})->name('detail-makanan');

//Favorite Routes
Route::get('/favorit', function () {
    return view('pages.Users.Favorit', [
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

//customer Routes
Route::middleware(['check.customer.role'])->group(
    function () {
        Route::get('/', [UserController::class, 'index'])->name('homepage');
    }
);



Route::middleware(['auth', 'verified', 'check.hasloggin'])->group(function () {
    //Pesanan Routes
    Route::post('/detail-makanan/{id}', [MenuController::class, 'simpan']);
    Route::post('/product', [MenuController::class, 'simpan'])->name('product.store');
    Route::get('/pesanan/status', [CartController::class, 'status']);
    //status pesanan sesuai dengan order_id
    Route::get('/pesanan/status/{orderID}', [CartController::class, 'StatusOrder'])->name('status.order');
    Route::get('/pesanan', [CartController::class, 'index']);
    Route::delete('/pesanan/delete', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post("/pesanan/update-quantity", [CartController::class, 'updateQuantity'])->name('update.quantity');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/pay/{orderID}', [CartController::class, 'pay'])->name('payment');
    Route::post('/pay/order/', [CartController::class, 'order'])->name('order');
    Route::post('/checkout/confirm', [CartController::class, 'confirmPay'])->name('confirm.pay');
    // User Chat page
    Route::get('/chats', [ChatController::class, 'listChat']);
    Route::post(
        '/room-chat',
        [ChatController::class, 'roomChat']
    )->name('room.chat');
});


// Courier Routes
Route::middleware(['auth', 'verified', 'check.courier.role'])->prefix('courier')->group(function () {
    Route::get('/dashboard', [CourierController::class, 'index'])->name('dashboardCourier');
    Route::get('/chats', [CourierController::class, 'listChat'])->name('chatpage');
    Route::post('/room-chat', [CourierController::class, 'roomChat'])->name('room.chat.courier');
    Route::view(
        '/history',
        'pages/Courier/riwayat',
        [
            'Title' => 'History',
        ]
    )->name('history');
    Route::get('/history/{id}', function ($id) {
        return view('pages/Courier/riwayatdetail', [
            'Title' => 'Detail History',
            'id' => $id,
        ]);
    })->name('historydetail');
    Route::view(
        '/profile',
        'pages/Courier/profile',
        [
            'Title' => 'Profile',
        ]
    )->name('profile');

    Route::get('/order', [CourierController::class, 'listOrder'])->name('courierorder');
    Route::get('/order/{id}', function ($id) {
        return view('pages/Courier/orderdetail', [
            'Title' => 'Order Detail',
            'id' => $id,
        ]);
    })->name('orderdetail');
    Route::post('/takeOrder', [CourierController::class, 'takeOrder'])->name('take.order');
});

// Admin Routes
Route::resource('umkm', 'UmkmController');
Route::middleware(['auth', 'verified', 'check.admin.role'])->prefix('admin')->group(function () {
    Route::view(
        '/dashboard',
        'pages/Admin/dashboard',
        [
            'data_umkm' => Data_umkm::all(),
            'menu' => Menu::all(),
            'user' => User::all(),
            'transaction' => app(TransactionController::class)->index(), //temporary data
        ]
    )->name('dashboard');
    Route::view('/umkm', 'pages/Admin/umkm', [
        'umkms' => Data_umkm::paginate(5),
    ])->name('umkm');
    Route::post('/umkm', [UmkmController::class, 'storeUmkm'])->name('umkm.store');
    Route::post('/products', [UmkmController::class, 'addProduct'])->name('save.product');
    Route::get('/product', function () {

        return view('pages/Admin/product', [
            'model' => new Menu(),
            'umkm' => Data_umkm::pluck('nama_umkm', 'id'),
            'umkms' => Data_umkm::all(),
            'menus' => Menu::paginate(5),
            'button' => 'SIMPAN',
            'route' => "product.store",
            'method' => 'POST'
        ]);
    })->name('product');



    // edit & delete product route
    //to edit product form
    Route::get('/product/{menu}/edit', function (Menu $menu) {
        return view('pages/admin/product_form', [
            'model' => $menu,
            'umkm' => Data_umkm::pluck('nama_umkm', 'id'),
            'button' => 'UPDATE',
            'route' => ['product.update', $menu->id],
            'method' => 'PUT'
        ]);
    })->name('product.edit');

    //data from edit product form
    Route::put('/product/{id}', [MenuController::class, 'update'])->name('product.update');
    //delete product

    Route::delete('/product/{menu}', [MenuController::class, 'destroy'])->name('product.destroy');

    // edit & delete umkm route

    //to edit umkm form
    Route::get('/umkm/{umkm}/edit', function (Data_umkm $umkm) {
        return view('pages/admin/umkm_update', [
            'umkm' => $umkm,
            'products' => Menu::where('data_umkm_id', $umkm->id)->get(),
        ]);
    })->name('umkm.edit');

    //data from edit umkm form
    Route::put('/umkm/{umkm}', [UmkmController::class, 'update'])->name('umkm.update');
    //delete umkm

    Route::delete('/umkm/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy');

    //transaction route
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');

    //account-user management route
    Route::view('/account', 'pages/Admin/account', [
        'users' => \App\Models\User::all(),
    ])->name('account');

    Route::post('/account/update/{userid}', [UserController::class, 'update'])->name('account.update');

    //chat route
    Route::view(
        '/chats',
        'pages/Admin/chatpage',
        [
            'Title' => 'Chat',
        ]
    )->name('chatpage.admin');

    Route::get('/chats/{id}', function ($id) {
        return view('pages/Admin/chatroom', [
            'Title' => 'Chat Room',
            'id' => $id,
        ]);
    })->name('chatroom.admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pesanan', [CartController::class, 'index']);
Route::post('/favoritStore/{menuId}', [FavoritController::class, 'favoritStore'])->name('favorite.add');


//searching routes
Route::get('/search-item', [MenuController::class, 'search_item'])->name('search-item'); // this will return nama_makanan from menu table (json)
Route::get('/search/{keyword}', [MenuController::class, 'search'])->name('search.keyword');

// User Route
Route::middleware(['auth', 'UserAccess:user,admin,courier'])->group(function () {
    Route::name('user.')->group(function () {
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
        Route::name('courier.')->group(function () {
            // Add more routes as needed
        });
    });
});


require __DIR__ . '/auth.php';
