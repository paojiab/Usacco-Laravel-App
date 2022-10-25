<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingProduct;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index() {
        $accounts = Account::latest()->get();
        return view('admin/accounts',compact('accounts'));
    }

    public function show($id) {
        $account = Account::find($id);
        return view('admin/account-show', compact('account'));
    }

    public function verify($id) {
        $account = Account::find($id);
        $account->update([
            'status' => 'verified'
        ]);

        $firstName = $account->first_name;
        $lastName = $account->last_name;

        $account->user->first()->update([
            'name' => $firstName . " " . $lastName
        ]);

        return redirect('admin/accounts')->with('status', 'Account verified successfully');
    }

    public function reject($id) {
        Account::find($id)->update([
            'status' => 'rejected'
        ]);

        return redirect('admin/accounts')->with('status', 'Account rejected successfully');
    }

    public function update(Request $request, $id)
    {
        $fields  = $request->validate([
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

        $fields['id_front'] = $request->file('id_front')->store('id-fronts', 'public');

        $fields['passport_photo'] = $request->file('passport_photo')->store('pass-photos', 'public');
        
        $fields['signature'] = $request->file('signature')->store('signatures', 'public');
    

        if ($request->hasFile('id_back')) {
            $fields['id_back'] = $request->file('id_back')->store('id-backs', 'public');
        }

        Account::find($id)->update($fields);

        return redirect('admin/accounts')->with('status', 'Account details updated successfully!');

    }

    public function destroy($id) {
        Account::find($id)->delete();
        return redirect()->back()->with('status', 'Account closed successfully!');
    }

    public function new($id){
        $user_id = $id;
        $products = SavingProduct::all();
        return view('admin.account-create',compact('products','user_id'));
    }

    public function create(Request $request, $user_id){
        $fields  = $request->validate([
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
            'status' => 'required'
        ]);

        $fields['user_id'] = $user_id;
        $fields['acct_no'] = '0100' . mt_rand(100000000, 999999999);

        $fields['id_front'] = $request->file('id_front')->store('id-fronts', 'public');

        $fields['passport_photo'] = $request->file('passport_photo')->store('pass-photos', 'public');
        
        $fields['signature'] = $request->file('signature')->store('signatures', 'public');
    

        if ($request->hasFile('id_back')) {
            $fields['id_back'] = $request->file('id_back')->store('id-backs', 'public');
        }

        Account::create($fields);

        return redirect()->route('member', $user_id)->with('status', 'New account has been created successfully!');
    }
}
