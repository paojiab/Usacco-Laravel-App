<?php

namespace App\Http\Controllers;

use App\Models\Account;

class SavingsController extends Controller
{
    public function index()
    {
        $accounts = auth()->user()->accounts()->get();
        return view('dashboard', compact('accounts'));
    }

    public function show($id){
        $account = Account::find($id);
        return view('usacco.savings', compact('account'));
    }
}
