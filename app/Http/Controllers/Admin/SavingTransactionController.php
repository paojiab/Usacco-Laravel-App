<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;

class SavingTransactionController extends Controller
{
    public function index()
    {
        $saving_txns = SavingTransaction::latest()->paginate(10);
        return view('admin/saving-transactions', compact('saving_txns'));
    }

    public function deposit(Request $request)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $txn_data['account_id'] = Account::where('acct_no', $request->account_no)->first()->id;
        $txn_data['txn_type'] = 'deposit';
        $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'success';

        SavingTransaction::create($txn_data)->account()->increment('account_balance', $request->amount);

        return redirect()->back()->with('status', 'Deposit completed successfully');
    }

    public function withdraw(Request $request)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $type = Account::where('acct_no', $request->account_no)->first()->acct_type;

        $charge = SavingProduct::where('type', $type)->first()->withdraw_charge;

        $min_bal = SavingProduct::where('type', $type)->first()->minimum_balance;

        $balance = Account::where('acct_no', $request->account_no)->first()->account_balance;

        $actual_bal = $balance - $min_bal;

        $fee = ($charge / 100) * $amount;

        $total = $fee + $amount;

        if ($total > $actual_bal) {
            $txn_data['account_id'] = Account::where('acct_no', $request->account_no)->first()->id;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
            $txn_data['status'] = 'failed';

            SavingTransaction::create($txn_data);

            return redirect()->back()->with('status', 'Insufficient funds');
        }

       else {

        $txn_data['account_id'] = Account::where('acct_no', $request->account_no)->first()->id;
        $txn_data['txn_type'] = 'withdraw';
        $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'success';
        $txn_data['fee'] = $fee;


        SavingTransaction::create($txn_data)->account()->decrement('account_balance', $total);

        return redirect()->back()->with('status', 'Withdraw completed successfully');
       }
    }
}
