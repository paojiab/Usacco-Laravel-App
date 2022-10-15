<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    public function index() {
        $account = auth()->user()->accounts()->first();
        $txns = $account->savingTransactions()->latest()->paginate(10);
        return view('dashboard',compact('account','txns'));
    }
}
