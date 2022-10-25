<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::find($id);
        return view('admin/profile',compact('user'));
    }

    public function store(Request $request,$id) {
        $user = User::find($id);
       $fields = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'username' => ['required', 'string', 'max:10', Rule::unique('users')->ignore($user->id)],
       ]);

       $user->update($fields);

       return redirect()->route('member',$id)->with('status','Profile updated successfully');
    }

    public function closed($id){
        $accounts = User::find($id)->accounts()->onlyTrashed()->get();
        return view('admin.closed',compact('accounts'));
    }

    public function restore($id){
        Account::withTrashed()->find($id)->restore();
        return redirect()->back()->with('status', 'Account restored successfully');
    }
}
