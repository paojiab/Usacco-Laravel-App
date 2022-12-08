<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SavingProductsController;
use App\Http\Controllers\Admin\SavingTransactionController;
use App\Http\Controllers\Admin\ShareController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WelfareProductController;
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

Route::post('accounts/store', [AccountController::class, 'store'])->middleware('auth')->name('accounts.store');

Route::get('notifications',[NotificationsController::class,'index'])->name('notifications')->middleware('auth');
Route::post('notifications/clear-all',[NotificationsController::class,'clearAll'])->middleware('auth')->name('clear.all');
Route::post('notifications/read-all',[NotificationsController::class,'readAll'])->middleware('auth')->name('read.all');
Route::post('mark/read/{id}',[NotificationsController::class,'markRead'])->middleware('auth')->name('mark.read');
Route::post('remove/{id}',[NotificationsController::class,'remove'])->middleware('auth')->name('remove');
Route::post('unread/{id}',[NotificationsController::class,'unread'])->middleware('auth')->name('unread');

// Admin Saving Products
Route::get('saving/product',[SavingProductsController::class, 'index'])->name('saving.products')->middleware('admin');
Route::post('saving/product/store',[SavingProductsController::class,'store'])->middleware('admin')->name('product.store');
Route::post('saving-product/delete/{id}',[SavingProductsController::class,'destroy'])->middleware('admin')->name('product.delete');
// End Admin Saving Products

// Admin Accounts
Route::get('admin/accounts',[AccountsController::class,'index'])->middleware('admin')->name('admin.accounts');
Route::get('/accounts/show/{id}',[AccountsController::class,'show'])->middleware('admin')->name('account.show');
Route::post('/account/verify/{id}',[AccountsController::class,'verify'])->middleware('admin')->name('account.verify');
Route::post('/account/reject/{id}',[AccountsController::class,'reject'])->middleware('admin')->name('account.reject');
Route::post('/account/update/{id}',[AccountsController::class,'update'])->middleware('admin')->name('account.update');
Route::post('/account/close/{id}',[AccountsController::class,'destroy'])->middleware('admin')->name('account.close');
Route::get('/account/new/{id}',[AccountsController::class,'new'])->middleware('admin')->name('account.new');
Route::post('/account/create/{user_id}',[AccountsController::class,'create'])->middleware('admin')->name('account.create');
// End Admin Accounts

// Admin Saving transactions
Route::get('admin/saving-txns/{id}',[SavingTransactionController::class,'show'])->middleware('admin')->name('admin.saving.txns');
Route::post('admin/savings/deposit/{id}',[SavingTransactionController::class, 'deposit'])->middleware('admin')->name('admin.savings.deposit');
Route::post('admin/savings/withdraw/{id}',[SavingTransactionController::class, 'withdraw'])->middleware('admin')->name('admin.savings.withdraw');
Route::post('admin/savings/transfer/{id}',[SavingTransactionController::class, 'transfer'])->middleware('admin')->name('savings.transfer');
// End admin saving transaction

// User transactions
Route::post('/user/deposit', [DepositController::class, 'initialize'])->middleware('auth')->name('user.savings.deposit');
Route::post('/user/withdraw', [WithdrawController::class, 'withdraw'])->middleware('auth')->name('user.savings.withdraw');
Route::get('/savings/stat/{id}', [SavingsStatController::class, 'convert'])->name('savings.stat')->middleware('auth');
Route::get('/savings/month/{id}', [SavingsStatController::class, 'month'])->name('savings.month')->middleware('auth');
Route::get('/savings/quarter/{id}', [SavingsStatController::class, 'quarter'])->name('savings.quarter')->middleware('auth');
Route::get('/savings/half/{id}', [SavingsStatController::class, 'half'])->name('savings.half')->middleware('auth');
// End user transactions

// Admin users
Route::get('admin/users',[UsersController::class,'index'])->middleware('admin')->name('admin.users');
Route::get('/admin/users/show/{id}',[UsersController::class,'show'])->middleware('admin')->name('member');
Route::get('/admin/users/transact/{id}',[UsersController::class,'transact'])->middleware('admin')->name('transact');
Route::get('/admin/users/register',[UsersController::class,'register'])->middleware('admin')->name('admin.users.register');
Route::post('/admin/users/register',[UsersController::class,'store'])->middleware('admin')->name('admin.users.store');
Route::get('/admin/savings/stat/{id}', [SavingsStatController::class, 'adminConvert'])->middleware('admin')->name('admin.savings.stat');
Route::get('/admin/savings/month/{id}', [SavingsStatController::class, 'adminMonth'])->middleware('admin')->name('admin.savings.month');
Route::get('/admin/savings/quarter/{id}', [SavingsStatController::class, 'adminQuarter'])->middleware('admin')->name('admin.savings.quarter');
Route::get('/admin/savings/half/{id}', [SavingsStatController::class, 'adminHalf'])->middleware('admin')->name('admin.savings.half');
Route::get('admin/users/profile/{id}',[ProfileController::class,'show'])->middleware('admin')->name('admin.users.profile');
Route::post('admin/users/profile/store/{id}',[ProfileController::class,'store'])->middleware('admin')->name('user.profile.store');
Route::get('admin/users/closed/{id}',[ProfileController::class,'closed'])->middleware('admin')->name('closed');
Route::post('admin/users/account/restore/{id}',[ProfileController::class,'restore'])->middleware('admin')->name('restore');
// End admin users

// Admin Shares
Route::get('share/products',[ShareController::class, 'index'])->middleware('admin')->name('share.products');
Route::post('share/products/store',[ShareController::class,'store'])->middleware('admin')->name('share.store');
// End admin shares

// user shares
Route::post('shares/buy',[SharesController::class, 'buy'])->middleware('auth')->name('buy');
Route::get('shares/show/{id}',[SharesController::class, 'show'])->name('share.show')->middleware('auth');
Route::post('shares/sell',[SharesController::class, 'sell'])->middleware('auth')->name('sell');
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

// Admin welfare Products
Route::get('welfare/products',[WelfareProductController::class, 'index'])->middleware('admin')->name('welfare.products');
Route::post('welfare/products/store',[WelfareProductController::class,'store'])->middleware('admin')->name('welfare.store');
// End admin welfare products

// User welfare
Route::post('/welfare/contribute', [WelfareController::class, 'contribute'])->middleware('auth')->name('contribute');
// end user wallfare

// Admin loan products
Route::get('admin/loan/products', [LoanProductController::class, 'index'])->middleware('admin')->name('loan.products');
Route::post('admin/loan/products',[LoanProductController::class, 'store'])->middleware('admin')->name('loan.products.store');
// end admin loan products

// User loans
Route::post('loan/store',[LoansController::class, 'store'])->middleware('auth')->name('loan.store');
Route::get('show/loan/{id}',[LoansController::class, 'show'])->middleware('auth')->name('loan.show');
Route::post('loan/repay/{id}',[LoansController::class, 'repay'])->middleware('auth')->name('loan.repay');
// End user loans

// admin loans
Route::get('admin/loans', [LoanController::class,'index'])->name('admin.loans')->middleware('admin');
Route::get('admin/loans/edit/{id}', [LoanController::class,'edit'])->name('loan.review')->middleware('admin');
Route::post('admin/loan/store/{id}', [LoanController::class,'store'])->middleware('admin')->name('loan.approve');
Route::post('admin/loan/update/{id}', [LoanController::class,'update'])->middleware('admin')->name('loan.restructure');
// end admin loans

// Admin finances
Route::get('admin/finances',[FinanceController::class,'index'])->name('admin.finances')->middleware('admin');
Route::get('monthly/cashflow',[FinanceController::class,'monthlyCashflow'])->middleware('admin')->name('monthly.cashflow');
Route::get('admin/profit/loss',[FinanceController::class,'profitLoss'])->middleware('admin')->name('profit.loss');
Route::get('admin/balance-sheet',[FinanceController::class,'balanceSheet'])->middleware('admin')->name('balance.sheet');

// end admin finances

// Admin statistics
Route::get('admin/statistics',[StatisticController::class,'index'])->name('admin.statistics')->middleware('admin');
// end admin statistics

// Admin dashboard
Route::post('dashboard/deposit',[DashboardController::class,'deposit'])->name('dashboard.deposit')->middleware('admin');
Route::post('dashboard/withdraw',[DashboardController::class,'withdraw'])->name('dashboard.withdraw')->middleware('admin');
Route::post('dashboard/user',[DashboardController::class,'user'])->name('dashboard.user')->middleware('admin');
Route::post('dashboard/account',[DashboardController::class,'account'])->name('dashboard.account')->middleware('admin');
Route::get('dashboard/review',[DashboardController::class,'review'])->name('dashboard.review')->middleware('admin');
Route::get('dashboard/loans/pending',[DashboardController::class,'loanPending'])->name('loans.pending')->middleware('admin');
Route::post('dashboard/shares',[DashboardController::class,'shares'])->name('dashboard.shares')->middleware('admin');
Route::post('dashboard/welfare',[DashboardController::class,'welfare'])->name('dashboard.welfare')->middleware('admin');
Route::post('dashboard/loans',[DashboardController::class,'newLoan'])->name('dashboard.loans')->middleware('admin');
Route::post('dashboard/notifications',[DashboardController::class,'notification'])->name('dashboard.notification')->middleware('admin');
// End admin dashboard