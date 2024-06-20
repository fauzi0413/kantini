<?php

use PharIo\Manifest\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataAkun;
use App\Http\Controllers\DataKantin;
use App\Http\Controllers\DataMenu;
use App\Http\Controllers\DataPesanan;
use App\Http\Controllers\DataRuko;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Auth::routes();

Auth::routes([
    'verify' => true
]);

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::middleware(['auth', 'verified'])->group(function () {
    //
    // ADMIN MIDDLEWARE
    //
    Route::get('/admin', [AdminController::class, 'index'])->middleware('userAkses:admin');
    Route::get('/dataakun/user', [AdminController::class, 'dataakun_user'])->middleware('userAkses:admin');
    Route::get('/dataakun/penjual', [AdminController::class, 'dataakun_penjual'])->middleware('userAkses:admin');
    Route::get('/dataakun/admin', [AdminController::class, 'dataakun_admin'])->middleware('userAkses:admin');
    Route::put('/verifikasiakun/{id}', [AdminController::class, 'verifikasiakun'])->middleware('userAkses:admin');

    // DATA AKUN
    Route::get('/dataakun', [DataAkun::class, 'index'])->middleware('userAkses:admin');
    Route::get('/dataakun/create', [DataAkun::class, 'create'])->middleware('userAkses:admin');
    Route::post('/dataakun/create', [DataAkun::class, 'store'])->middleware('userAkses:admin');
    Route::get('/dataakun/edit/{id}', [DataAkun::class, 'edit'])->middleware('userAkses:admin');
    Route::put('/dataakun/edit/{id}', [DataAkun::class, 'update'])->middleware('userAkses:admin');
    Route::get('/dataakun/delete/{id}', [DataAkun::class, 'destroy'])->middleware('userAkses:admin');

    // DATA KANTIN
    Route::get('/datakantin', [DataKantin::class, 'index'])->middleware('userAkses:admin');
    Route::get('/datakantin/create', [DataKantin::class, 'create'])->middleware('userAkses:admin');
    Route::post('/datakantin/create', [DataKantin::class, 'store'])->middleware('userAkses:admin');
    Route::get('/datakantin/edit/{id}', [DataKantin::class, 'edit'])->middleware('userAkses:admin');
    Route::put('/datakantin/edit/{id}', [DataKantin::class, 'update'])->middleware('userAkses:admin');
    Route::get('/datakantin/delete/{id}', [DataKantin::class, 'destroy'])->middleware('userAkses:admin');

    // DATA RUKO
    Route::get('/dataruko', [DataRuko::class, 'index'])->middleware('userAkses:admin');
    Route::get('/dataruko/create', [DataRuko::class, 'create'])->middleware('userAkses:admin');
    Route::post('/dataruko/create', [DataRuko::class, 'store'])->middleware('userAkses:admin');
    Route::get('/dataruko/edit/{id}', [DataRuko::class, 'edit'])->middleware('userAkses:admin');
    Route::put('/dataruko/edit/{id}', [DataRuko::class, 'update'])->middleware('userAkses:admin');
    Route::get('/dataruko/delete/{id}', [DataRuko::class, 'destroy'])->middleware('userAkses:admin');
    //
    // END ADMIN MIDDLEWARE
    //

    //
    // PENJUAL MIDDLEWARE
    //

    Route::get('/penjual', [PenjualController::class, 'index'])->middleware('userAkses:penjual');
    Route::put('/penjual/edit/{id}', [PenjualController::class, 'update_penjual'])->middleware('userAkses:penjual');
    Route::get('/datatransaksi', [PenjualController::class, 'transaksi'])->middleware('userAkses:penjual');

    // DATA PESANAN
    Route::get('/datapesanan', [DataPesanan::class, 'index'])->middleware('userAkses:penjual');
    Route::get('/ubahstatus/{status}/{id}', [DataPesanan::class, 'status'])->middleware('userAkses:penjual');

    //DATA MENU
    Route::get('/datamenu', [DataMenu::class, 'index'])->middleware('userAkses:penjual');
    Route::get('/datamenu/create', [DataMenu::class, 'create'])->middleware('userAkses:penjual');
    Route::post('/datamenu/create', [DataMenu::class, 'store'])->middleware('userAkses:penjual');
    Route::get('/datamenu/edit/{id}', [DataMenu::class, 'edit'])->middleware('userAkses:penjual');
    Route::put('/datamenu/edit/{id}', [DataMenu::class, 'update'])->middleware('userAkses:penjual');
    Route::get('/datamenu/delete/{id}', [DataMenu::class, 'destroy'])->middleware('userAkses:penjual');

    //
    // END PENJUAL MIDDLEWARE
    //

    //
    // PEMBELI MIDDLEWARE
    //
    Route::get('/', [UserController::class, 'index'])->middleware('userAkses:user');
    Route::get('/kantin/{id}', [UserController::class, 'kantin'])->middleware('userAkses:user');
    Route::get('/cart/tambah/{id}', [UserController::class, 'beli'])->middleware('userAkses:user');
    Route::get('/cart/hapus/{id}', [UserController::class, 'hapus'])->middleware('userAkses:user');

    Route::post('/jumlah/tambah/{id}', [UserController::class, 'tambah'])->middleware('userAkses:user');
    Route::post('/catatan/tambah/{id}', [UserController::class, 'tambah_catatan'])->middleware('userAkses:user');

    Route::post('/transaksi/tambah', [UserController::class, 'tambah_transaksi'])->middleware('userAkses:user');

    Route::get('/riwayat-pesanan', [UserController::class, 'riwayat_pesanan'])->middleware('userAkses:user');
    Route::get('/ubahstatus/{status}/{id}', [UserController::class, 'status'])->middleware('userAkses:user');

    //
    // END PEMBELI MIDDLEWARE
    //

    Route::get('/logout', [HomeController::class, 'logout']);
});
