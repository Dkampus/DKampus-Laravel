<?php

use App\Http\Controllers\AdminController;
use App\Models\Addresse;
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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UntukKamuController;
use App\Http\Controllers\CsController;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    return view('pages.Users.KategoriMenu', [
        'Title' => 'Kategori ' . $value,
        'Kategori' => $value,
        'menus' => Menu::where('category', $value)->get(),
    ]);
});

Route::get('/sheetsData', [AdminController::class, 'convertXls']);

// Ubah Kata Sandi
Route::get('/change-password', function () {
    return view('pages.Users.UbahKataSandi', [
        'Title' => 'Ubah Kata Sandi',
    ]);
});

// Rekomendasi Warung page
Route::get('/rekomendasi-warung', function () {
    return view('pages.Users.RekomendasiWarungPage', [
        'Title' => 'Rekomendasi Warung',
        'RekomendasiWarung' => Data_umkm::all(),
    ]);
});

// Rekomendasi Menu page
Route::get('/rekomendasi-menu', function () {
    return view('pages.Users.RekomendasiMenuPage', [
        'Title' => 'Rekomendasi Menu',
        'RekomendasiMenu' => Menu::all(),
        'umkm' => Data_umkm::where('id', Menu::first()->data_umkm_id)->first(),
    ]);
});

// Promo Page
Route::get('/promo', function () {
    return view('pages.Users.SemuaPage', [
        'Title' => 'Promo',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Semua',
        'CategoryPromo' => PromoModel::promoCategory(),
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'UmkmHavePromo' => PromoModel::promoUmkm(),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo/semua', function (UmkmController $umkmController) {
    $Jarak = [];
    if (\Illuminate\Support\Facades\Auth::user() != null) {
        $umkmGeo = [];
        for ($i = 0; $i < count(PromoModel::promoSpecial()); $i++) {
            $umkmGeo[] = Data_umkm::where('id', PromoModel::promoSpecial()[$i]->data_umkm_id)->first()->id;
        }
        //        for ($i = 0; $i < count($umkmGeo); $i++) {
        //            $Jarak[] = $umkmController->getDistance(Auth::user()->id, $umkmGeo[$i]);
        //        }
    } else {
        $Jarak = null;
    }
    return view('pages.Users.PromoSemuaPage', [
        'Title' => 'Semua Promo',
        'promoSpecial' => PromoModel::promoSpecial(),
        'umkm' => Data_umkm::all(),
        //        'jarakUmkm' => $Jarak,
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
    ]);
});

Route::get('/promo/category/{value}', function ($value) {
    return view('pages.Users.PromoCategoryPage', [
        'Title' => 'Promo ' . ucfirst($value),
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'menus' => Menu::all(),
        'CategoryPromo' => PromoModel::promoCategory(),
        'UmkmHavePromo' => PromoModel::promoUmkm(),
        'NavPromo' => ucfirst($value),
        'CarouselPromo' => PromoModel::carouselPromo(),
        'FooterPart1' => Footer::footerPart1(),
        'FooterPart2Beli' => Footer::footerPart2Beli(),
        'FooterPart2Jual' => Footer::footerPart2Jual(),
        'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
        'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
    ]);
});

Route::get('/promo/special', function (UmkmController $umkmController) {
    $Jarak = [];
    if (\Illuminate\Support\Facades\Auth::user() != null) {
        $umkmGeo = [];
        for ($i = 0; $i < count(PromoModel::promoSpecial()); $i++) {
            $umkmGeo[] = Data_umkm::where('id', PromoModel::promoSpecial()[$i]->data_umkm_id)->first()->id;
        }
        //        for ($i = 0; $i < count($umkmGeo); $i++) {
        //            $Jarak[] = $umkmController->getDistance(Auth::user()->id, $umkmGeo[$i]);
        //        }
    } else {
        $Jarak = null;
    }
    //    dd($Jarak);
    return view('pages.Users.PromoSpecialPage', [
        'Title' => 'Promo Special',
        'promoSpecial' => PromoModel::promoSpecial(),
        'umkm' => Data_umkm::all(),
        'jarakUmkm' => $Jarak,
    ]);
});

Route::get('/promo/makanan', function () {
    return view('pages.Users.MakananPage', [
        'Title' => 'Promo',
        'PromoTerlarisSlider' => PromoModel::promoTerlaris(),
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'NavPromo' => 'Makanan',
        'CategoryPromo' => PromoModel::promoCategory(),
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
        'CategoryPromo' => PromoModel::promoCategory(),
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

// Detail Routes
Route::get('/detail-warung/{umkm:nama_umkm}', function (Data_umkm $umkm) {
    return view('pages.Users.DetailWarung', [
        'nama_umkm' => $umkm->nama_umkm,
        'alamat' => $umkm->alamat,
        'rating' => $umkm->rating,
        'CardFood' => $umkm->menu,
        'umkm_img' => $umkm->logo_umkm,
        'open_time' => $umkm->open_time,
        'close_time' => $umkm->close_time,
        'rating' => $umkm->rating,
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
        'umkm_nama' => Data_umkm::where('id', $menu->data_umkm_id)->first()->nama_umkm,
        'nama_makanan' => $menu->nama_makanan,
        'rating' => $menu->rating,
        'harga' => number_format($menu->harga, 0, ',', '.'),
        'deskripsi' => $menu->deskripsi,
        'CardFood' => Menu::where('data_umkm_id', $menu->data_umkm_id)->get(),
    ]);
})->name('detail-makanan');

//Favorit Routes
Route::get('/favorit', function (UmkmController $umkmController) {
    $Jarak = [];
    try {
        if (\Illuminate\Support\Facades\Auth::user() != null) {
            $umkmGeo = [];
            for ($i = 0; $i < count(PromoModel::promoSpecial()); $i++) {
                $umkmGeo[] = Data_umkm::where('id', PromoModel::promoSpecial()[$i]->data_umkm_id)->first()->id;
            }
            //            for ($i = 0; $i < count($umkmGeo); $i++) {
            //                $Jarak[] = $umkmController->getDistance(Auth::user()->id, $umkmGeo[$i]);
            //            }
        }
    } catch (Exception $e) {
        $Jarak = null;
    }
    return view('pages.Users.Favorit', [
        'Title' => 'Favorit',
        'PengaturanAkun' => HomeModel::pengaturanAkun(),
        'SeputarDkampus' => HomeModel::seputarDkampus(),
        'RekomendasiWarung' => Data_umkm::all(),
        //        'listJarak' => $Jarak,
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
    Route::get('/pesanan', [CartController::class, 'index']);
    Route::post('/detail-makanan/{id}', [MenuController::class, 'simpan']);
    Route::post('/product', [MenuController::class, 'simpan'])->name('product.store');
    Route::get('/pesanan/status', [CartController::class, 'status']);
    Route::post('/pesanan/status/detail', [CartController::class, 'StatusOrder'])->name('status.order');
    Route::post('/detail-Order', [CartController::class, 'detailHistory'])->name('historydetail.cust');
    Route::post('/rating', [CartController::class, 'rating'])->name('rating');
    Route::get('/pesanan', [CartController::class, 'index']);
    Route::delete('/pesanan/delete', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post("/pesanan/update-quantity", [CartController::class, 'updateQuantity'])->name('update.quantity');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/pay/{orderID}', [CartController::class, 'pay'])->name('payment');
    Route::post('/pay/order/', [CartController::class, 'order'])->name('order');
    Route::post('/checkout/confirm', [CartController::class, 'confirmPay'])->name('confirm.pay');
    // User Chat page
    Route::get('/chats', [ChatController::class, 'listChat']);
    Route::post('/room-chat', [ChatController::class, 'roomChat'])->name('room.chat');
    Route::post('/uploadChatImage', [ChatController::class, 'uploadChatImage']);
    Route::post('/chatbot', [CsController::class, 'bot'])->name('chatbot');
    // Daftar Alamat
    Route::get('/daftar-alamat', [UserController::class, 'indexAlamat'])->name('alamat');
    Route::post('/daftar_alamat', [UserController::class, 'daftarAlamat'])->name('daftar.alamat');
    Route::post('/defaul-address', [UserController::class, 'alamatUtama'])->name('alamatUtama');
    Route::post('/delete-address', [UserController::class, 'deleteAlamat'])->name('delete.alamat');

    // Jastip Page
    Route::get('/jastip', [CartController::class, 'jastipIndex'])->name('jastip.index');
    Route::post('/jastip-post', [CartController::class, 'jastip'])->name('jastip.order');

    // Cs Help
    Route::post('/help', [CsController::class, 'start'])->name('cs.help');
});


// Courier Routes
Route::middleware(['auth', 'verified', 'check.courier.role'])->prefix('courier')->group(function () {
    Route::post('/orders/delete', [CourierController::class, 'cancelOrder'])->name('delete.orders');
    Route::post('orders/complete', [CourierController::class, 'completeOrder'])->name('complete.orders');
    Route::get('/dashboard', [CourierController::class, 'index'])->name('dashboardCourier');
    Route::get('/chats', [CourierController::class, 'listChat'])->name('chatpage');
    Route::post('/room-chat', [CourierController::class, 'roomChat'])->name('room.chat.courier');
    Route::post('/uploadChatImageCour', [CourierController::class, 'uploadChatImageCour']);
    Route::get('/history', [CourierController::class, 'history'])->name('cour.history');
    Route::post('/detail-history', [CourierController::class, 'detailHistory'])->name('historydetail');
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
    Route::post('/take-Order', [CourierController::class, 'takeOrder'])->name('take.order');
});

// Admin Routes
Route::resource('umkm', 'UmkmController');
Route::middleware(['auth', 'verified', 'check.admin.role'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::view('/umkm', 'pages/Admin/umkm', [
        'umkms' => Data_umkm::paginate(10),
    ])->name('umkm');
    Route::post('/umkm-save', [UmkmController::class, 'storeUmkm'])->name('umkm.save');
    Route::post('/products', [UmkmController::class, 'addProduct'])->name('save.product');
    Route::get('/product', function () {
        return view('pages/Admin/product', [
            'model' => new Menu(),
            'umkms' => Data_umkm::all(),
            'menus' => Menu::paginate(10),
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
    Route::put('/product/{id}', [MenuController::class, 'update'])->name('productUpdate');
    //delete product

    Route::delete('/product/{menu}', [MenuController::class, 'destroy'])->name('productDestroy');

    // edit & delete umkm route

    //to edit umkm form
    Route::get('/umkm/{umkm}/edit', function (Data_umkm $umkm) {
        return view('pages/admin/umkm_update', [
            'umkm' => $umkm,
            'products' => Menu::where('data_umkm_id', $umkm->id)->get(),
        ]);
    })->name('umkmEdit');

    //data from edit umkm form
    Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('umkmUpdate');
    //delete umkm

    Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('umkmDestroy');

    //transaction route
    Route::get('/transaction', [AdminController::class, 'transacation'])->name('transaction');

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
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/favoritStore/{menuId}', [FavoritController::class, 'favoritStore'])->name('favorite.add');


//searching routes
Route::get('/search/menu', [MenuController::class, 'search'])->name('search.menu');
Route::get('/search/umkm', [UmkmController::class, 'search'])->name('search.umkm');
Route::get('/search', function (Request $request) {
    $keyword = $request->keyword;
    $umkms = Data_umkm::where('nama_umkm', 'like', '%' . $keyword . '%')->get();
    $menus = Menu::where('nama_makanan', 'like', '%' . $keyword . '%')->with('data_umkm')->get();
    $menus = $menus->map(function ($menu) {
        $menu->nama_umkm = $menu->data_umkm->nama_umkm;
        return $menu;
    });
    return view('pages.Users.SearchPage', [
        'Title' => 'Search ' . ucfirst($keyword),
        'umkms' => $umkms,
        'menus' => $menus,
    ]);
});

Route::post('/register-token', [NotificationController::class, 'registerToken'])->name('register.token');
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');
Route::post('/send-notification-cour', [NotificationController::class, 'sendNotificationToCouriers'])->name('send.notificationCour');
Route::get('/wa.me/{phone}', [ChatController::class, 'redirectWhatsApp']);
Route::get('/spreadsheets', [AdminController::class, 'spreadsheets']);
Route::post('/userDetails', [AdminController::class, 'getUserDetails']);


require __DIR__ . '/auth.php';
