<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

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

// -------------- Admin Auth  routes ..................
Route::prefix('admin')->group(function () {
    // Login Admin
    Route::get('login', [AdminAuthController::class, 'loginForm'])->name('admin.login.form')->middleware('admin.guest');
    Route::post('login/post', [AdminAuthController::class, 'login'])->name('admin.login');

    // Admin dashboard  
    Route::get('dashboard', [AdminAuthController::class, 'index'])->name('admin.dashboard')->middleware('admin');

    // Register admin
    Route::get('register',[AdminAuthController::class, 'registerForm'])->name('admin.register.form')->middleware('admin.guest');
    Route::post('register/post',[AdminAuthController::class, 'register'])->name('admin.register');

    // Logout admin
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('admin');
});

// -------------- End Admin Auth routes ..................

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
