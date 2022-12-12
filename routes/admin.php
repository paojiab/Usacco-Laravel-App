<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\LoanProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SavingProductsController;
use App\Http\Controllers\Admin\SavingTransactionController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Pdf\SavingsStatController;

// -------------- Admin Routes ..................
Route::prefix('admin')->middleware('admin.guest')->group(function () {
    // ---------- Login Admin ----------------
    Route::get('login', [AdminAuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('login/post', [AdminAuthController::class, 'login'])->name('admin.login');

    // ---------------- Register Admin ----------
    Route::get('register', [AdminAuthController::class, 'registerForm'])->name('admin.register.form');
    Route::post('register/post', [AdminAuthController::class, 'register'])->name('admin.register');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    // ------------------------ Admin dashboard --------------- 
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminAuthController::class, 'index'])->name('admin.dashboard');
        Route::post('deposit', [DashboardController::class, 'deposit'])->name('dashboard.deposit');
        Route::post('withdraw', [DashboardController::class, 'withdraw'])->name('dashboard.withdraw');
        Route::post('user', [DashboardController::class, 'user'])->name('dashboard.user');
        Route::post('account', [DashboardController::class, 'account'])->name('dashboard.account');
        Route::get('review', [DashboardController::class, 'review'])->name('dashboard.review');
        Route::get('loans/pending', [DashboardController::class, 'loanPending'])->name('loans.pending');
        Route::post('shares', [DashboardController::class, 'shares'])->name('dashboard.shares');
        Route::post('welfare', [DashboardController::class, 'welfare'])->name('dashboard.welfare');
        Route::post('loans', [DashboardController::class, 'newLoan'])->name('dashboard.loans');
        Route::post('repay', [DashboardController::class, 'repay'])->name('dashboard.repay');
        Route::post('notifications', [DashboardController::class, 'notification'])->name('dashboard.notification');
    });
    // --------------- End Admin Dashbaord --------------------

    // ---------- Logout Admin ----------------
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // ----------End Logout Admin --------------

    // --------------- Admin Saving Products ---------------
    Route::get('saving/product', [SavingProductsController::class, 'index'])->name('saving.products');
    Route::post('saving/product/store', [SavingProductsController::class, 'store'])->name('product.store');
    Route::post('saving-product/delete/{id}', [SavingProductsController::class, 'destroy'])->name('product.delete');
    // ---------------- End Admin Saving Products ---------------

    // -------------- Admin Accounts ----------------
    Route::prefix('accounts')->group(function(){
        Route::get('/', [AccountsController::class, 'index'])->name('admin.accounts');
        Route::get('show/{id}', [AccountsController::class, 'show'])->name('account.show');
        Route::post('verify/{id}', [AccountsController::class, 'verify'])->name('account.verify');
        Route::post('reject/{id}', [AccountsController::class, 'reject'])->name('account.reject');
        Route::post('update/{id}', [AccountsController::class, 'update'])->name('account.update');
        Route::post('close/{id}', [AccountsController::class, 'destroy'])->name('account.close');
        Route::get('new/{id}', [AccountsController::class, 'new'])->name('account.new');
        Route::post('create/{user_id}', [AccountsController::class, 'create'])->name('account.create');
    });
    // ----------- End Admin Accounts ----------------

    // ------------------- Admin Saving Transactions ---------------------
    Route::get('saving-txns/{id}', [SavingTransactionController::class, 'show'])->name('admin.saving.txns');
    Route::post('savings/deposit/{id}', [SavingTransactionController::class, 'deposit'])->name('admin.savings.deposit');
    Route::post('savings/withdraw/{id}', [SavingTransactionController::class, 'withdraw'])->name('admin.savings.withdraw');
    Route::post('savings/transfer/{id}', [SavingTransactionController::class, 'transfer'])->name('savings.transfer');
    // ------------------- End Admin Saving Transactions --------------------

    // ---------------- Admin Users -------------------
    Route::prefix('users')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('admin.users');
    Route::get('show/{id}', [UsersController::class, 'show'])->name('member');
    Route::get('transact/{id}', [UsersController::class, 'transact'])->name('transact');
    Route::get('register', [UsersController::class, 'register'])->name('admin.users.register');
    Route::post('register', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('savings/stat/{id}', [SavingsStatController::class, 'adminConvert'])->name('admin.savings.stat');
    Route::get('savings/month/{id}', [SavingsStatController::class, 'adminMonth'])->name('admin.savings.month');
    Route::get('savings/quarter/{id}', [SavingsStatController::class, 'adminQuarter'])->name('admin.savings.quarter');
    Route::get('savings/half/{id}', [SavingsStatController::class, 'adminHalf'])->name('admin.savings.half');
    Route::get('profile/{id}', [ProfileController::class, 'show'])->name('admin.users.profile');
    Route::post('profile/store/{id}', [ProfileController::class, 'store'])->name('user.profile.store');
    Route::get('closed/{id}', [ProfileController::class, 'closed'])->name('closed');
    Route::post('account/restore/{id}', [ProfileController::class, 'restore'])->name('restore');
    });
    // ----------------- End Admin Users --------------------

    // ----------------- Admin Shares ----------------------
    Route::resource('products/shares','App\Http\Controllers\Admin\ShareController');
    // --------------- End Admin Shares -------------------

    // ------------------- Admin Welfare Products -------------------------
    Route::resource('products/welfare','App\Http\Controllers\Admin\WelfareProductController');
    // ----------------------- End Admin Welfare Products ------------------

    // -------------- Admin Loans -------------------
    Route::prefix('loans')->group(function () {
        Route::get('products', [LoanProductController::class, 'index'])->name('loan.products');
        Route::post('products', [LoanProductController::class, 'store'])->name('loan.products.store');
    });
    Route::resource('loans','App\Http\Controllers\Admin\LoanController');
    // -------------- End Admin Loans ----------------

    // --------------- Admin Finances ---------------
    Route::get('finances', [FinanceController::class, 'index'])->name('admin.finances');
    Route::get('monthly/cashflow', [FinanceController::class, 'monthlyCashflow'])->name('monthly.cashflow');
    Route::get('profit/loss', [FinanceController::class, 'profitLoss'])->name('profit.loss');
    Route::get('balance-sheet', [FinanceController::class, 'balanceSheet'])->name('balance.sheet');
    // -------------- End Admin Finances ----------------

    // ---------------- Admin Statistics ------------------
    Route::get('statistics', [StatisticController::class, 'index'])->name('admin.statistics');
    // ------------------ End Admin Statistics ---------------

});

// -------------- End Admin Routes ..................
