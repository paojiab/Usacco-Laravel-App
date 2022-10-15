<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $products = SavingProduct::all();
        return view('usacco/account-create', compact('products'));
    }

    public function store(Request $request)
    {
        $fields  = $request->validate([
            'acct_type' => 'required',
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

        $fields['user_id'] = auth()->id();
        $fields['status'] = 'pending';
        $fields['acct_no'] = '0100' . mt_rand(100000000, 999999999);

        if($request->hasFile('id_front')) {
        $fields['id_front'] = $request->file('id_front')->store('id-fronts', 'public');
        }

        if ($request->hasFile('id_back')) {
            $fields['id_back'] = $request->file('id_back')->store('id-backs', 'public');
        }

        if($request->hasFile('passport_photo')) {
        $fields['passport_photo'] = $request->file('passport_photo')->store('pass-photos', 'public');
        }

        if($request->hasFile('signature')) {
        $fields['signature'] = $request->file('signature')->store('signatures', 'public');
        }

        Account::create($fields);

        User::find(auth()->user()->id)->update([
            'name' => $request->first_name . $request->last_name
        ]);

        return redirect('dashboard')->with('status', 'Account details sent successfully, wait for verification!');

    }
}
