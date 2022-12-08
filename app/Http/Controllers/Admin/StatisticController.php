<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        $users = User::all()->count();
        $accounts = Account::all()->count();
        $sTxns = SavingTransaction::all()->count();
        $deposits = SavingTransaction::where('txn_type','deposit')->get()->count();
        $withdraws = SavingTransaction::where('txn_type','withdraw')->get()->count();
        $savings = Account::all()->sum('account_balance');
        $wFee = SavingTransaction::where('txn_type','withdraw')->get()->sum('fee');
        $closed = Account::onlyTrashed()->count();
        $close = Account::onlyTrashed()->sum('account_balance');
        $inactive = Account::where('status','inactive')->get()->count();
        $inactiv = Account::where('status','inactive')->get()->sum('account_balance');
        $deposit = SavingTransaction::where('txn_type','deposit')->get()->sum('amount');
        $withdraw = SavingTransaction::where('txn_type','withdraw')->get()->sum('amount');
        $interest = SavingTransaction::where('txn_type','interest')->get()->sum('amount');
        return view('admin.statistic',compact('users','accounts','deposits','withdraws','savings','wFee',
    'closed','inactive','inactiv','deposit','withdraw','sTxns','close','interest'));
    }
}
