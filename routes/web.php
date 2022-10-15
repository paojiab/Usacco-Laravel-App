<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\SavingProductsController;
use App\Http\Controllers\Admin\SavingTransactionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\Payment\DepositController;
use App\Http\Controllers\Payment\WithdrawController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\WelfareController;

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
    Route::get('/dashboard', [SavingsController::class, 'index'])->name('dashboard');
});

// Route::get('/savings', [SavingsController::class, 'index'])->name('savings');

Route::get('/shares', [SharesController::class, 'index'])->name('shares')->middleware('auth');

Route::get('/loans', [LoansController::class, 'index'])->name('loans')->middleware('auth');

Route::get('/welfare', [WelfareController::class, 'index'])->name('welfare')->middleware('auth');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio')->middleware('auth');

Route::get('accounts/create', [AccountController::class, 'index'])->name('accounts.create')->middleware('auth');

Route::post('accounts/store', [AccountController::class, 'store'])->name('accounts.store');

// Admin Saving Products
Route::get('saving/product',[SavingProductsController::class, 'index'])->name('saving.products')->middleware('admin');
Route::post('saving/product/store',[SavingProductsController::class,'store'])->name('product.store');
Route::post('saving-product/delete/{id}',[SavingProductsController::class,'destroy'])->name('product.delete');
// End Admin Saving Products

// Admin Accounts
Route::get('admin/accounts',[AccountsController::class,'index'])->name('admin.accounts');
Route::get('/accounts/show/{id}',[AccountsController::class,'show'])->name('account.show');
Route::post('/account/verify/{id}',[AccountsController::class,'verify'])->name('account.verify');
Route::post('/account/reject/{id}',[AccountsController::class,'reject'])->name('account.reject');
Route::post('/account/update/{id}',[AccountsController::class,'update'])->name('account.update');
Route::post('/account/close/{id}',[AccountsController::class,'destroy'])->name('account.close');
// End Admin Accounts

// Admin Saving transactions
Route::get('admin/saving-txns',[SavingTransactionController::class,'index'])->name('admin.saving.txns');
Route::post('admin/savings/deposit',[SavingTransactionController::class, 'deposit'])->name('admin.savings.deposit');
Route::post('admin/savings/withdraw',[SavingTransactionController::class, 'withdraw'])->name('admin.savings.withdraw');
// End admin saving transaction

// User transactions
Route::post('/user/deposit', [DepositController::class, 'initialize'])->name('user.savings.deposit');
Route::get('/deposit/callback/{account_id}/{amount}', [DepositController::class, 'callback'])->name('deposit.callback');
Route::post('/user/withdraw', [WithdrawController::class, 'withdraw'])->name('user.savings.withdraw');
Route::get('/withdraw/callback/{id}/{account_id}', [WithdrawController::class, 'callback'])->name('withdraw.callback');
// End user transactions

// Admin users
Route::get('admin/users',[UsersController::class,'index'])->name('admin.users');
// End admin users