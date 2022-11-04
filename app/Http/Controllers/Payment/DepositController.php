<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingTransaction;
use App\Models\WalletTransaction;
use App\Notifications\DepositNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    public function initialize(Request $request){
        $request->validate([
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $id = $request->account_id;

        $account = Account::find($id);

        $user = auth()->user();

        $wallet_balance = $user->wallet;

        $balance = $account->account_balance;

        if($amount > $wallet_balance) {
            return redirect()->route('savings',$id)->with('status', 'Insufficient funds. Add money to your wallet to continue.');
        } else if($amount<=0){
            return redirect()->route('savings',$id)->with('status', 'Amount should be greater than zero');
        } else {
            $txn_data['amount'] = $amount;
            $txn_data['txn_type'] = 'deposit';
            $txn_data['balance'] = $balance + $amount;
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $id;

            SavingTransaction::create($txn_data);
            $account->increment('account_balance', $amount);

            $txn_data['txn_type'] = 'transfer to savings';
            $txn_data['user_id'] = auth()->id();
            $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
            $txn_data['status'] = 'successful';
            $txn_data['balance'] = auth()->user()->wallet - $amount;
            WalletTransaction::create($txn_data);
            $account->user->decrement('wallet', $amount);
            return redirect()->route('savings',$id)->with('status', 'Deposit from wallet to savings account completed successfully');
        }
    }
}
