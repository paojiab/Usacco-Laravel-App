<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
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

// -------------- Admin routes ..................
include('admin.php');
// -------------- End Admin routes ..................

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

Route::post('accounts/store', [AccountController::class, 'store'])->middleware('auth')->name('accounts.store');

Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications')->middleware('auth');
Route::post('notifications/clear-all', [NotificationsController::class, 'clearAll'])->middleware('auth')->name('clear.all');
Route::post('notifications/read-all', [NotificationsController::class, 'readAll'])->middleware('auth')->name('read.all');
Route::post('mark/read/{id}', [NotificationsController::class, 'markRead'])->middleware('auth')->name('mark.read');
Route::post('remove/{id}', [NotificationsController::class, 'remove'])->middleware('auth')->name('remove');
Route::post('unread/{id}', [NotificationsController::class, 'unread'])->middleware('auth')->name('unread');



// User transactions
Route::post('/user/deposit', [DepositController::class, 'initialize'])->middleware('auth')->name('user.savings.deposit');
Route::post('/user/withdraw', [WithdrawController::class, 'withdraw'])->middleware('auth')->name('user.savings.withdraw');
Route::get('/savings/stat/{id}', [SavingsStatController::class, 'convert'])->name('savings.stat')->middleware('auth');
Route::get('/savings/month/{id}', [SavingsStatController::class, 'month'])->name('savings.month')->middleware('auth');
Route::get('/savings/quarter/{id}', [SavingsStatController::class, 'quarter'])->name('savings.quarter')->middleware('auth');
Route::get('/savings/half/{id}', [SavingsStatController::class, 'half'])->name('savings.half')->middleware('auth');
// End user transactions



// user shares
Route::post('shares/buy', [SharesController::class, 'buy'])->middleware('auth')->name('buy');
Route::get('shares/show/{id}', [SharesController::class, 'show'])->name('share.show')->middleware('auth');
Route::post('shares/sell', [SharesController::class, 'sell'])->middleware('auth')->name('sell');
// end user shares

// wallet

Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->middleware('auth')->name('wallet.deposit');
Route::get('/wallet/deposit/callback', [WalletController::class, 'depositCallback'])->name('wallet.deposit.callback')->middleware('auth');
Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->middleware('auth')->name('wallet.withdraw');
Route::get('/wallet/withdraw/callback/{id}', [WalletController::class, 'withdrawCallback'])->name('wallet.withdraw.callback')->middleware('auth');
Route::get('/wallet/statement', [WalletTransactionsController::class, 'convert'])->name('wallet.statement')->middleware('auth');
Route::get('/wallet/month', [WalletTransactionsController::class, 'month'])->name('wallet.month')->middleware('auth');
Route::get('/wallet/quarter', [WalletTransactionsController::class, 'quarter'])->name('wallet.quarter')->middleware('auth');
Route::get('/wallet/half', [WalletTransactionsController::class, 'half'])->name('wallet.half')->middleware('auth');
// end user wallet



// User welfare
Route::post('/welfare/contribute', [WelfareController::class, 'contribute'])->middleware('auth')->name('contribute');
// end user wallfare



// User loans
Route::post('loan/store', [LoansController::class, 'store'])->middleware('auth')->name('loan.store');
Route::get('show/loan/{id}', [LoansController::class, 'show'])->middleware('auth')->name('loan.show');
Route::post('loan/repay/{id}', [LoansController::class, 'repay'])->middleware('auth')->name('loan.repay');
// End user loans

