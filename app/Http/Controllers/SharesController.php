<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\ShareProduct;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class SharesController extends Controller
{
    public function index() {
        $products = ShareProduct::latest()->paginate(5);
        $txns = Share::where('user_id', auth()->id())->latest()->paginate(10);
        return view('usacco/shares',compact('products','txns'));
    }

    public function show($id){
        $product = ShareProduct::find($id);
        return view('usacco.share',compact('product'));
    }

    public function buy(Request $request){
        $fields = $request->validate([
            'share_product_id' => 'required',
            'amount' => 'required',
            'price' => 'required'
        ]);

        $amount = $request->amount;
        $price = $request->price;
        $user = auth()->user();
        $user_id = auth()->id();
        $wallet_balance = $user->wallet;
        $product = ShareProduct::find($request->share_product_id);

        if($amount > $wallet_balance){
            return redirect()->back()->with('status','Insufficient funds. Add money to your wallet to continue');
        } else if ($amount < $product->price){
            return redirect()->back()->with('status','You should buy atleast one share');
        } else{
            $fields['shares'] = $amount/$price;
            $fields['user_id'] = $user_id;  
             Share::create($fields);

             $txn_data['amount'] = $amount;
             $txn_data['txn_type'] = 'bought share(s) from wallet';
            $txn_data['user_id'] = auth()->id();
            $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
            $txn_data['status'] = 'successful';
            $txn_data['balance'] = auth()->user()->wallet - $amount;
            WalletTransaction::create($txn_data);
             $user->decrement('wallet', $amount);
        return redirect()->back()->with('status','Share(s) bought successfully');
        }

    }

    public function sell(Request $request){
        $request->validate([
            'amount' => 'required'
        ]);

        $amount = $request->amount;
        $share_id = $request->share_product_id;
        $user_id = auth()->id();
        $product = ShareProduct::find($share_id);
        $fee = $product->selling_fee/100 * $amount;
        $total = $amount + $fee;
        $share_balance = $product->shares()->where('user_id',$user_id)->sum('shares');
        $worth = $product->price * $share_balance;
        if ($total > $worth || $amount <=0) {
            return redirect()->back()->with('status', 'You do not have enough shares to complete the transaction');
        } else {
            $fields['share_product_id'] = $share_id;
            $fields['shares'] = -($total/$product->price);
            $fields['user_id'] = $user_id;  
             Share::create($fields);

             $txn_data['amount'] = $amount;
             $txn_data['txn_type'] = 'sold share(s) to wallet';
            $txn_data['user_id'] = auth()->id();
            $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
            $txn_data['status'] = 'successful';
            $txn_data['balance'] = auth()->user()->wallet + $amount;
            $txn_data['fee'] = $fee;
            WalletTransaction::create($txn_data);
             auth()->user()->increment('wallet', $amount);
        return redirect()->back()->with('status','Share(s) Sold Successfully');
        }
    }
}
