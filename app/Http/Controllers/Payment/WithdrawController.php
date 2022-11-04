<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\CheckWithdrawStatus;
use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function withdraw(Request $request){
        $request->validate([
            'amount' => 'required'
        ]);

        $amount = $request->amount;
        $id = $request->account_id;
        $account = Account::find($id);
        $charge = $account->savingProduct->withdraw_charge;
        $fee = ($charge/100) * $amount;
        $total = $amount + $fee;
        $balance =$account->account_balance;
        $min_bal = $account->savingProduct->minimum_balance;
        $actual_bal = $balance - $min_bal;
        if ($total > $actual_bal){
            return redirect()->route('savings',$id)->with('status', 'Insufficient funds');
        }else if($amount<=0){
            return redirect()->route('savings',$id)->with('status', 'Amount should be greater than zero');
        } else {

            $txn_data['amount'] = $amount;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['balance'] = $balance - $total;
            $txn_data['fee'] = $fee;
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $id;

            SavingTransaction::create($txn_data);

            $account->decrement('account_balance', $total);

            $txn_data['txn_type'] = 'deposit from savings';
            $txn_data['user_id'] = auth()->id();
            $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
            $txn_data['status'] = 'successful';
            $txn_data['balance'] = auth()->user()->wallet + $amount;
            $txn_data['fee'] = 0.00;
            WalletTransaction::create($txn_data);
            $account->user->increment('wallet', $amount);
            return redirect()->route('savings',$id)->with('status', 'Savings withdraw to wallet completed successfully');
        }
    }
}
