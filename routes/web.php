<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/admin', function () {
    if (Auth::check()) {
        $userRole = Auth::user()->role_id;

        if ($userRole == 1) {
            return view('admin.dashboard');  // Admin
        } elseif ($userRole == 2) {
            return redirect('/home');  // User biasa
        } else {
            return redirect('/home')->with('error', 'Akses ditolak.');  // Akses ditolak
        }
    }
    return redirect('/login'); 
})->middleware('auth');  


 


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth','role:1']);


Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('/register', function () {
    return view('auth.register');
});
Route::resource('users', UserController::class);
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::resource('products', ProductController::class);

Route::resource('products', ProductController::class);