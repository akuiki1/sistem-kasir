<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('admin.index');
	})->name('dashboard');

	Route::get('catatan-transaksi', function () {
		return view('admin.transaksi.index');
	})->name('catatan-transaksi');

	Route::get('profile', function () {
		return view('admin.profil.index');
	})->name('profile');

	Route::post('/update-image', [InfoUserController::class, 'updateImage'])->name('user.update_image');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('kasir', function () {
		return view('kasir/index');
	})->name('kasir');

	Route::get('karyawan', function () {
		return view('admin.karyawan.index');
	})->name('karyawan');

	Route::get('data-produk', function () {
		return view('admin.produk.index');
	})->name('data-produk');

    Route::get('stok-produk', function () {
		return view('admin.stok.index');
	})->name('stok-produk');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/profil', [InfoUserController::class, 'create']);
	Route::post('/profil', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');