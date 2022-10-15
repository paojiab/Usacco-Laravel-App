<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index() {
        $accounts = Account::all();
        return view('admin/accounts',compact('accounts'));
    }

    public function show($id) {
        $account = Account::find($id);
        return view('admin/account-show', compact('account'));
    }

    public function verify($id) {
        Account::find($id)->update([
            'status' => 'verified'
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

        Account::find($id)->update($fields);

        return redirect('admin/accounts')->with('status', 'Account details updated successfully!');

    }

    public function destroy($id) {
        Account::find($id)->delete();
        return redirect()->back()->with('status', 'Account closed successfully!');
    }
}
