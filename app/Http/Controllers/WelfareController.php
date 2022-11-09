<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use App\Models\Welfare;
use App\Models\WelfareProduct;
use Illuminate\Http\Request;

class WelfareController extends Controller
{
    public function index() {
        $txns = Welfare::where('user_id',auth()->id())->latest()->paginate(10);
        $monthly_amount = Welfare::where('user_id',auth()->id() && 'created_at',now()->subDays(30))->get()->sum('amount');
        return view('usacco/welfare',compact('txns','monthly_amount'));
    }

    public function contribute(Request $request){
        $fields = $request->validate([
            'amount' => 'required'
        ]);

        $wallet_balance = auth()->user()->wallet;

        if($fields['amount'] > $wallet_balance) {
            return redirect()->back()->with('status', 'Insufficient funds. Add money to your wallet');
        } else if ($fields['amount'] <=0) {
        return redirect()->back()->with('status', 'Amount must be greater than zero!');
     } else{ 
        $fields['user_id'] = auth()->id();
        $fields['welfare_product_id'] = WelfareProduct::first()->id;
        Welfare::create($fields);

        $txn_data['amount'] = $fields['amount'];
        $txn_data['txn_type'] = 'contribution to welfare';
       $txn_data['user_id'] = auth()->id();
       $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
       $txn_data['status'] = 'successful';
       $txn_data['balance'] = auth()->user()->wallet - $fields['amount'];
       WalletTransaction::create($txn_data);
        auth()->user()->decrement('wallet', $fields['amount']);
        return redirect()->back()->with('status', 'Welfare contribution completed succesfully');
     }
    }
}
