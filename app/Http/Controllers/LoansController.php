<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\LoanTransaction;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function index() {
        $products = LoanProduct::all();
        $loans = auth()->user()->loans()->latest()->paginate(5);
        $balance = auth()->user()->loans()->where('status','Open')->get()->sum('balance');
        $txns = LoanTransaction::where('user_id',auth()->id())->latest()->paginate(10);
        return view('usacco/loans',compact('products','balance','loans','txns'));
    }

    public function show($id) {
        $loan = Loan::find($id);
        $loanId = 'USL/'. auth()->id() . "/" . $loan->id;
        return view('usacco.loan-show',compact('loan','loanId'));
    }

    public function store(Request $request){
        $fields = $request->validate([
            'reason' => 'required',
            'principal' => 'required',
            'loan_product_id' => 'required',
            'collateral_url' => 'max:5000',
            'collateral_ownership_url' => 'max:5000',
            'guarantor',
            'collateral',
        ]);

        $loanProduct = LoanProduct::find($fields['loan_product_id']);
        $fields['user_id'] = auth()->id();
        $fields['title'] = $loanProduct->name . " " . auth()->user()->name;
        $fields['interest'] = $loanProduct->interest;
        $fields['duration'] = $loanProduct->loan_duration;
        $fields['loan_fee'] = $loanProduct->loan_fee;
        $fields['disburse_amount'] = $request->principal - $loanProduct->loan_fee;
        $fields['status'] = 'Pending';

        if ($request->hasFile('collateral_url')) {
            $fields['collateral_url'] = $request->file('collateral_url')->store('collateral', 'public');
        }

        if ($request->hasFile('collateral_ownership_url')) {
            $fields['collateral_url'] = $request->file('collateral_ownership_url')->store('collateral-ownership', 'public');
        }

        Loan::create($fields);
        return redirect()->back()->with('status', 'Loan application submitted successfully');
    }

    public function repay(Request $request, $id){
        $request->validate([
            'amount' => 'required'
        ]);
        $loan = Loan::find($id);
        if ($request->amount > auth()->user()->wallet) {
            return redirect()->back()->with('status', 'Insufficient balance, Add funds to wallet to continue');
        } else if ($request->amount > $loan->balance) {
            return redirect()->back()->with('status', 'Amount should be less or equal to loan balance');
        } else if ($request->amount <= 0){
            return redirect()->back()->with('status', 'Amount should be greater than zero');
        } else{

        $loan->user->decrement('wallet', $request->amount);
        $loan->decrement('balance', $request->amount);

        $txn_data['txn_type'] = 'Loan Repayment';
        $txn_data['user_id'] = auth()->id();
        $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['balance'] = auth()->user()->wallet - $request->amount;
        $txn_data['amount'] = $request->amount;
        WalletTransaction::create($txn_data);
        
        $txn_data['loan_id'] = $loan->id;
        $txn_data['balance'] = $loan->balance;
        LoanTransaction::create($txn_data);
        return redirect()->route('loans')->with('status', 'Loan repayment made successfully');
        }
    }
}
