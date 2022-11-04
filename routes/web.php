<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SavingProductsController;
use App\Http\Controllers\Admin\SavingTransactionController;
use App\Http\Controllers\Admin\ShareController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Payment\DepositController;
use App\Http\Controllers\Payment\WithdrawController;
use App\Http\Controllers\Pdf\SavingsStatController;
use App\Http\Controllers\Pdf\WalletTransactionsController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SavingsController;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\WalletController;
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

Route::get('/savings/{id}', [SavingsController::class, 'show'])->name('savings')->middleware('auth');

Route::get('/shares', [SharesController::class, 'index'])->name('shares')->middleware('auth');

Route::get('/loans', [LoansController::class, 'index'])->name('loans')->middleware('auth');

Route::get('/welfare', [WelfareController::class, 'index'])->name('welfare')->middleware('auth');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio')->middleware('auth');

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet')->middleware('auth');

Route::get('accounts/create', [AccountController::class, 'index'])->name('accounts.create')->middleware('auth');

Route::post('accounts/store', [AccountController::class, 'store'])->name('accounts.store');

Route::get('notifications',[NotificationsController::class,'index'])->name('notifications')->middleware('auth');
Route::post('notifications/clear-all',[NotificationsController::class,'clearAll'])->name('clear.all');
Route::post('notifications/read-all',[NotificationsController::class,'readAll'])->name('read.all');
Route::post('mark/read/{id}',[NotificationsController::class,'markRead'])->name('mark.read');
Route::post('remove/{id}',[NotificationsController::class,'remove'])->name('remove');
Route::post('unread/{id}',[NotificationsController::class,'unread'])->name('unread');

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
Route::get('/account/new/{id}',[AccountsController::class,'new'])->name('account.new');
Route::post('/account/create/{user_id}',[AccountsController::class,'create'])->name('account.create');
// End Admin Accounts

// Admin Saving transactions
Route::get('admin/saving-txns/{id}',[SavingTransactionController::class,'show'])->name('admin.saving.txns');
Route::post('admin/savings/deposit/{id}',[SavingTransactionController::class, 'deposit'])->name('admin.savings.deposit');
Route::post('admin/savings/withdraw/{id}',[SavingTransactionController::class, 'withdraw'])->name('admin.savings.withdraw');
Route::post('admin/savings/transfer/{id}',[SavingTransactionController::class, 'transfer'])->name('savings.transfer');
// End admin saving transaction

// User transactions
Route::post('/user/deposit', [DepositController::class, 'initialize'])->name('user.savings.deposit');
Route::post('/user/withdraw', [WithdrawController::class, 'withdraw'])->name('user.savings.withdraw');
Route::get('/savings/stat/{id}', [SavingsStatController::class, 'convert'])->name('savings.stat')->middleware('auth');
Route::get('/savings/month/{id}', [SavingsStatController::class, 'month'])->name('savings.month')->middleware('auth');
Route::get('/savings/quarter/{id}', [SavingsStatController::class, 'quarter'])->name('savings.quarter')->middleware('auth');
Route::get('/savings/half/{id}', [SavingsStatController::class, 'half'])->name('savings.half')->middleware('auth');
// End user transactions

// Admin users
Route::get('admin/users',[UsersController::class,'index'])->name('admin.users');
Route::get('/admin/users/show/{id}',[UsersController::class,'show'])->name('member');
Route::get('/admin/users/transact/{id}',[UsersController::class,'transact'])->name('transact');
Route::get('/admin/users/register',[UsersController::class,'register'])->name('admin.users.register');
Route::post('/admin/users/register',[UsersController::class,'store'])->name('admin.users.store');
Route::get('/admin/savings/stat/{id}', [SavingsStatController::class, 'adminConvert'])->name('admin.savings.stat');
Route::get('/admin/savings/month/{id}', [SavingsStatController::class, 'adminMonth'])->name('admin.savings.month');
Route::get('/admin/savings/quarter/{id}', [SavingsStatController::class, 'adminQuarter'])->name('admin.savings.quarter');
Route::get('/admin/savings/half/{id}', [SavingsStatController::class, 'adminHalf'])->name('admin.savings.half');
Route::get('admin/users/profile/{id}',[ProfileController::class,'show'])->name('admin.users.profile');
Route::post('admin/users/profile/store/{id}',[ProfileController::class,'store'])->name('user.profile.store');
Route::get('admin/users/closed/{id}',[ProfileController::class,'closed'])->name('closed');
Route::post('admin/users/account/restore/{id}',[ProfileController::class,'restore'])->name('restore');
// End admin users

// Admin Shares
Route::get('share/products',[ShareController::class, 'index'])->middleware('admin')->name('share.products');
Route::post('share/products/store',[ShareController::class,'store'])->name('share.store');
// End admin shares

// user shares
Route::post('shares/buy',[SharesController::class, 'buy'])->name('buy');
Route::get('shares/show/{id}',[SharesController::class, 'show'])->name('share.show')->middleware('auth');
Route::post('shares/sell',[SharesController::class, 'sell'])->name('sell');
// end user shares

// wallet

Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
Route::get('/wallet/deposit/callback', [WalletController::class, 'depositCallback'])->name('wallet.deposit.callback')->middleware('auth');
Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
Route::get('/wallet/withdraw/callback/{id}', [WalletController::class, 'withdrawCallback'])->name('wallet.withdraw.callback')->middleware('auth');
Route::get('/wallet/statement', [WalletTransactionsController::class, 'convert'])->name('wallet.statement')->middleware('auth');
Route::get('/wallet/month', [WalletTransactionsController::class, 'month'])->name('wallet.month')->middleware('auth');
Route::get('/wallet/quarter', [WalletTransactionsController::class, 'quarter'])->name('wallet.quarter')->middleware('auth');
Route::get('/wallet/half', [WalletTransactionsController::class, 'half'])->name('wallet.half')->middleware('auth');
// end user wallet