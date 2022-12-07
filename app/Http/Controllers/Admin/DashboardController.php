<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\SavingTransaction;
use App\Models\Share;
use App\Models\ShareProduct;
use App\Models\User;
use App\Models\Welfare;
use App\Notifications\DashboardNotification;
use App\Notifications\DepositNotification;
use App\Notifications\WithdrawNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function user(Request $request) {
        $user = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user['username'] = $request->email;
        $user['password'] = Hash::make(str::random(8));

        User::create($user);

        return redirect()->back()->with('status', 'New user created succesfully.');
    }

    public function deposit(Request $request){
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $account = Account::where('acct_no', $txn_data['account_no'])->first();

        $txn_data['account_id'] = $account->id;
        $txn_data['txn_type'] = 'deposit';
        $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['balance'] = $account->account_balance + $request->amount;

        SavingTransaction::create($txn_data)->account()->increment('account_balance', $request->amount);

        $account->user->notify(new DepositNotification($txn_data));

        return redirect()->back()->with('status', 'Deposit of UGX ' . $request->amount . ' to Account ' . $request->account_no . ' completed successfully with
        Reference ' . $txn_data['reference'] . '. New account balance is UGX ' . $txn_data['balance']);
    }

    public function withdraw(Request $request)
    {
        $txn_data = $request->validate([
            'account_no' => ['required', 'exists:accounts,acct_no'],
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $account = Account::where('acct_no', $txn_data['account_no'])->first();

        $charge = $account->savingProduct->withdraw_charge;

        $min_bal = $account->savingProduct->minimum_balance;

        $balance = $account->account_balance;

        $actual_bal = $balance - $min_bal;

        $fee = ($charge / 100) * $amount;

        $total = $fee + $amount;

        if ($total > $actual_bal) {
            return redirect()->back()->with('status', 'Insufficeint funds! Withdraw of UGX ' . $amount . ' at a fee of UGX ' . $fee . ' is more than Actual balance UGX ' . $actual_bal);
        }

       else {

        $txn_data['account_id'] = $account->id;
        $txn_data['txn_type'] = 'withdraw';
        $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['fee'] = $fee;
        $txn_data['balance'] = $balance - $total;


        SavingTransaction::create($txn_data)->account()->decrement('account_balance', $total);

        $account->user->notify(new WithdrawNotification($txn_data));

        return redirect()->back()->with('status', 'Withdraw of UGX ' . $request->amount . ' from Account ' . $request->account_no . ' completed successfully at a fee of UGX ' . $txn_data['fee'] . ' with
        Reference ' . $txn_data['reference'] . '. New account balance is UGX ' . $txn_data['balance']);
       }
    }

    public function account(Request $request)
    {
        $fields  = $request->validate([
            'user_id' => 'required',
            'saving_product_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'occupation' => 'required',
            'date_of_birth' => 'required',
            'tel' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'next_of_kin' => 'required',
            'rel_kin' => 'required',
            'tel_kin' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'id_front' => 'required|max:5000',
            'id_back' => 'max:5000',
            'passport_photo' => 'required|max:5000',
            'signature' => 'required|max:5000',
        ]);

        $fields['status'] = 'verified';

        $fields['acct_no'] = '0100' . mt_rand(100000000, 999999999);

        $fields['id_front'] = $request->file('id_front')->store('id-fronts', 'public');

        $fields['passport_photo'] = $request->file('passport_photo')->store('pass-photos', 'public');
      
        $fields['signature'] = $request->file('signature')->store('signatures', 'public');

        if ($request->hasFile('id_back')) {
            $fields['id_back'] = $request->file('id_back')->store('id-backs', 'public');
        }

        Account::create($fields);

        return redirect()->back()->with('status', 'New account created successfully');

    }

    public function review(){
        $accounts = Account::where('status','pending')->get();
        return view('admin.account_review',compact('accounts'));
    }

    public function shares(Request $request){
        $fields = $request->validate([
            'user_id' => 'required',
            'share_product_id' => 'required',
            'amount' => 'required'
        ]);

        $shareProduct = ShareProduct::find($fields['share_product_id']);

        $fields['shares'] = $fields['amount']/$shareProduct->price;
        Share::create($fields);
        return redirect()->back()->with('status', 'Shares bought successfully');
    }

    public function welfare(Request $request){
        $fields = $request->validate([
            'user_id' => 'required',
            'welfare_product_id' => 'required',
            'amount' => 'required'
        ]);
        
        Welfare::create($fields);
        return redirect()->back()->with('status', 'Welfare contribution completed successfully');
    }

    public function newLoan(Request $request){
        $fields = $request->validate([
            'user_id' => 'required',
            'reason' => 'required',
            'principal' => 'required',
            'loan_product_id' => 'required',
            'collateral_url' => 'max:5000',
            'collateral_ownership_url' => 'max:5000',
            'guarantor',
            'collateral',
        ]);

        $user = User::find($fields['user_id']);

        $loanProduct = LoanProduct::find($fields['loan_product_id']);
        $fields['title'] = $loanProduct->name . " " . $user->name;
        $fields['interest'] = $loanProduct->interest;
        $fields['duration'] = $loanProduct->loan_duration;
        $fields['loan_fee'] = $loanProduct->loan_fee;
        $fields['disburse_amount'] = $request->principal - $loanProduct->loan_fee;
        $fields['status'] = 'Open';

        if ($request->hasFile('collateral_url')) {
            $fields['collateral_url'] = $request->file('collateral_url')->store('collateral', 'public');
        }

        if ($request->hasFile('collateral_ownership_url')) {
            $fields['collateral_url'] = $request->file('collateral_ownership_url')->store('collateral-ownership', 'public');
        }

        Loan::create($fields);
        return redirect()->back()->with('status', 'Loan opened successfully');
    }

    public function loanPending(){
        $loans = Loan::where('status', 'Pending')->get();
        return view('admin.loan-pending',compact('loans'));
    }

    public function notification(Request $request){
        $request->validate(['message' => 'required']);
        $message = $request->message;
        $users = User::all();
        Notification::send($users, new DashboardNotification($message));
        return redirect()->back()->with('status', 'Notification successfully sent to all Users');
    }
}
