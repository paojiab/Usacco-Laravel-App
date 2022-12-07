<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;
use App\Notifications\DepositNotification;
use App\Notifications\WithdrawNotification;
use App\Notifications\TransferNotification;

class SavingTransactionController extends Controller
{
    public function show($id)
    {
        $account = Account::find($id);
        $saving_txns = $account->savingTransactions()->latest()->paginate(10);
        return view('admin/saving-transactions', compact('saving_txns','account'));
    }

    public function deposit(Request $request,$id)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $account = Account::find($id);

        $txn_data['account_id'] = $id;
        $txn_data['txn_type'] = 'deposit';
        $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['balance'] = $account->account_balance + $request->amount;

        SavingTransaction::create($txn_data)->account()->increment('account_balance', $request->amount);

        $account->user->notify(new DepositNotification($txn_data));

        return redirect()->back()->with('status', 'Deposit completed successfully');
    }

    public function withdraw(Request $request,$id)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $account = Account::find($id);

        $charge = $account->savingProduct->withdraw_charge;

        $min_bal = $account->savingProduct->minimum_balance;

        $balance = $account->account_balance;

        $actual_bal = $balance - $min_bal;

        $fee = ($charge / 100) * $amount;

        $total = $fee + $amount;

        if ($total > $actual_bal) {
            return redirect()->back()->with('status', 'Insufficient funds');
        }

       else {

        $txn_data['account_id'] = $id;
        $txn_data['txn_type'] = 'withdraw';
        $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['fee'] = $fee;
        $txn_data['balance'] = $balance - $total;


        SavingTransaction::create($txn_data)->account()->decrement('account_balance', $total);

        $account->user->notify(new WithdrawNotification($txn_data));

        return redirect()->back()->with('status', 'Withdraw completed successfully');
       }
    }

    public function transfer(Request $request,$id)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required',
            'receive' => 'required'
        ]);

        $amount = $request->amount;

        $account = Account::find($id);

        $transfer_fee = $account->savingProduct->transfer_fee;

        $min_bal = $account->savingProduct->minimum_balance;

        $balance = $account->account_balance;

        $actual_bal = $balance - $min_bal;

        $fee = ($transfer_fee / 100) * $amount;

        $total = $fee + $amount;

        if ($total > $actual_bal) {
            return redirect()->back()->with('status', 'Insufficient funds');
        }

       else {

        $txn_data['account_id'] = $id;
        $txn_data['txn_type'] = 'transfer';
        $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['fee'] = $fee;
        $txn_data['balance'] = $balance - $request->amount;


        SavingTransaction::create($txn_data)->account()->decrement('account_balance', $total);

        $account->user->notify(new TransferNotification($txn_data));

        $receive = Account::where('acct_no', $request->receive)->first();

        $txn_data['amount'] = $request->amount;
        $txn_data['account_no'] = $request->account_no;
        $txn_data['account_id'] = $receive->id;
        $txn_data['txn_type'] = 'deposit';
        $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['balance'] = $receive->account_balance + $request->amount;
        $txn_data['fee'] = 0;

        SavingTransaction::create($txn_data)->account()->increment('account_balance', $request->amount);

        $receive->user->notify(new DepositNotification($txn_data));

        return redirect()->back()->with('status', 'Transfer completed successfully');
    }
}
}
