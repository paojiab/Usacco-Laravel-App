<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanProduct;
use Illuminate\Http\Request;

class LoanProductController extends Controller
{
    public function index() {
        $products = LoanProduct::all();
        return view('admin.loan-product',compact('products'));
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'interest' => 'required',
            'loan_fee' => 'required',
            'minimum' => 'required',
            'maximum' => 'required',
            'loan_duration' => 'required'
        ]);

        LoanProduct::create($fields);
        return redirect()->route('loan.products')->with('status', 'New Loan Product created succesfully');
    }
}
