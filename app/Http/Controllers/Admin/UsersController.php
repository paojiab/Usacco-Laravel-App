<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(10);
        return view('admin/users',compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        $accounts = $user->accounts()->latest()->get();
        return view('admin/member',compact('user','accounts'));
    }

    public function register(){
        $products = SavingProduct::all();
        return view('admin.register',compact('products'));
    }

    public function transact($id){
        $account = Account::find($id);
        return view('admin.transact',compact('account'));
    }

    public function store(Request $request){
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
            'status' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user_id = User::insertGetId([
            'name' => $request->first_name . " " . $request->last_name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => Hash::make(Str::random(8)),
            'created_at' => Carbon::now()
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

        return redirect()->route('admin.users')->with('status', 'New user & account created successfully!');
    }
}
