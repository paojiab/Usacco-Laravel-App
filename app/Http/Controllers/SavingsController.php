<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\User;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    public function index()
    {
        $accounts = auth()->user()->accounts()->get();
        return view('dashboard', compact('accounts'));
    }

    public function show($id){
        $account = Account::find($id);
        $min_bal = $account->savingProduct->minimum_balance;
        $actual_bal = $account->account_balance - $min_bal;
        $txns = $account->savingTransactions()->latest()->paginate(10);
        return view('usacco.savings', compact('account', 'txns','actual_bal'));
    }
}
