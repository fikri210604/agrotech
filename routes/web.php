<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// =================== PUBLIC ====================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index']);

Route::get('/cari', function () {
    return view('cari-rental');
});

Route::get('/cari-produk', [ProductController::class,'index'])->name('products.search');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/register', [AuthController::class, 'registerIndex'])->name('register.index')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =================== PROTECTED / ADMIN ====================
Route::middleware('auth')->group(function () {

    // Redirect setelah login
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Optional route khusus admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Perusahaan
    Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/edit', [CompanyController::class, 'edit'])->name('perusahaan.edit');
    Route::post('/perusahaan', [CompanyController::class, 'store'])->name('perusahaan.store');
    Route::put('/perusahaan', [CompanyController::class, 'update'])->name('perusahaan.update');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
});
