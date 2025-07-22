<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Master2Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route untuk halaman Login
Route::post('/login/sukses', [AuthController::class, 'login'])->name('login.form');

// Route untuk halaman Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/sukses', [AuthController::class, 'register'])->name('register.form');


//route latihan
Route::get('pelanggan/create',[PelangganController::class,'create'])->name('pelanggan.create');
Route::post('pelanggan/store',[PelangganController::class,'store'])->name('pelanggan.store');

// Route untuk edit data pelanggan
Route::get('pelanggan/edit/{param1}', [PelangganController::class, 'edit'])->name('pelanggan.edit');

// Route untuk update data pelanggan
Route::post('pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update');

// Route untuk menghapus data pelanggan
Route::get('pelanggan/{param1}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

//route mitra
Route::get('mitra/create',[MitraController::class,'create'])->name('mitra.create');
Route::post('mitra/store',[MitraController::class,'store'])->name('mitra.store');
Route::get('mitra/edit/{param1}', [MitraController::class, 'edit'])->name('mitra.edit');
Route::post('mitra/update', [MitraController::class, 'update'])->name('mitra.update');
Route::get('mitra/{param1}', [MitraController::class, 'destroy'])->name('mitra.destroy');

//route partial view
Route::get('master', [MasterController::class, 'index'])->name('master');
Route::get('master2', [Master2Controller::class, 'index'])->name('master2');

//route middleware

Route::get('dashboardadmin',[DashboardController::class,'index'])->name('dashboard');
Route::get('mitra',[MitraController::class,'index'])->name('mitra.list');
Route::get('pelanggan',[PelangganController::class,'index'])->name('pelanggan.list');
Route::group(['middleware'=>['checkislogin']],function(){

});
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//route user
Route::get('user/create',[UserController::class,'create'])->name('user.create');
Route::post('user/store',[UserController::class,'store'])->name('user.store');
Route::get('user/edit/{param1}', [UserController::class, 'edit'])->name('user.edit');
Route::post('user/update', [UserController::class, 'update'])->name('user.update');
Route::get('user/{param1}', [UserController::class, 'destroy'])->name('user.destroy');

//route middleware role
Route::group(['middleware'=>['checkrole:admin']],function(){
});
Route::get('user',[UserController::class,'index'])->name('user.list');

//route produk
Route::get('produk',[ProdukController::class,'index'])->name('produk.list');
Route::get('produk/create',[ProdukController::class,'create'])->name('produk.create');
Route::post('produk/store',[ProdukController::class,'store'])->name('produk.store');
Route::get('produk/edit/{param1}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::post('produk/update', [ProdukController::class, 'update'])->name('produk.update');
Route::get('produk/{param1}', [ProdukController::class, 'destroy'])->name('produk.destroy');

//google
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('redirect.google');
Route::get('/burhan', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
