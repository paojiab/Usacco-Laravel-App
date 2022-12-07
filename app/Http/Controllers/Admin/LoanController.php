<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanTransaction;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $loans = Loan::latest()->paginate(20);
        return view('admin.loans',compact('loans'));
    }

    public function edit($id){
        $loan = Loan::find($id);
        return view('admin.loan-review',compact('loan'));
    }

    public function store(Request $request,$id){
        $fields = $request->validate([
            'title' => 'required',
            'principal' => 'required',
            'interest' => 'required',
            'duration' => 'required',
            'loan_fee' => 'required',
            'disburse_amount' => 'required',
            'reason' => 'required',
            'guarantor',
            'collateral',
            'collateral_url' => 'max:5000',
            'collateral_ownership_url' => 'max:5000'
        ]);

        if ($request->hasFile('collateral_url')) {
            $fields['collateral_url'] = $request->file('collateral_url')->store('collateral', 'public');
        }

        if ($request->hasFile('collateral_ownership_url')) {
            $fields['collateral_url'] = $request->file('collateral_ownership_url')->store('collateral-ownership', 'public');
        }

        Loan::find($id)->user->increment('wallet', $request->disburse_amount);

        $txn_data['txn_type'] = 'Loan Disbursement';
        $txn_data['user_id'] = Loan::find($id)->user_id;
        $txn_data['reference'] = '90' . mt_rand(100000000, 999999999);
        $txn_data['status'] = 'successful';
        $txn_data['balance'] = Loan::find($id)->user->wallet + $request->disburse_amount;
        $txn_data['fee'] = $request->loan_fee;
        $txn_data['amount'] = $request->disburse_amount;
        WalletTransaction::create($txn_data);

        $loanBalance = $request->principal + ($request->interest/100 * $request->principal * $request->duration);

        $txn_data['loan_id'] = Loan::find($id)->id;
        $txn_data['balance'] = $loanBalance;
        LoanTransaction::create($txn_data);

        $fields['status'] = 'Open';
        $fields['release_date'] = Carbon::now();
        $fields['maturity_date'] = Carbon::now()->addMonths($request->duration);
        $fields['balance'] = $loanBalance;

        Loan::find($id)->update($fields);
        return redirect()->back()->with('status', 'Loan Approved and funds Disbursed successfully');
    }

    public function update(Request $request, $id){
        $fields = $request->validate([
            'title' => 'required',
            'principal' => 'required',
            'interest' => 'required',
            'duration' => 'required',
            'loan_fee' => 'required',
            'disburse_amount' => 'required',
            'reason' => 'required',
            'guarantor',
            'collateral',
            'collateral_url' => 'max:5000',
            'collateral_ownership_url' => 'max:5000',
            'status' => 'required',
            'maturity_date',
            'balance' => 'required'
        ]);

        if ($request->hasFile('collateral_url')) {
            $fields['collateral_url'] = $request->file('collateral_url')->store('collateral', 'public');
        }

        if ($request->hasFile('collateral_ownership_url')) {
            $fields['collateral_url'] = $request->file('collateral_ownership_url')->store('collateral-ownership', 'public');
        }

        Loan::find($id)->update($fields);
        return redirect()->back()->with('status', 'Loan restructured successfully');
    }
}
