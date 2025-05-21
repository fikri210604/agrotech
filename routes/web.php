<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/cari', function () {
    return view('cari-rental');
});
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth');


Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/register', [AuthController::class, 'registerIndex'])->name('register.index');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); 
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan.index'); // tampilkan profil
Route::get('/perusahaan/edit', [CompanyController::class, 'edit'])->name('perusahaan.edit'); // halaman edit
Route::post('/perusahaan', [CompanyController::class, 'store'])->name('perusahaan.store'); // simpan baru (kalau pakai)
Route::put('/perusahaan', [CompanyController::class, 'update'])->name('perusahaan.update'); // update data perusahaan


Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');