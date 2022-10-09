<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class AdminAuthController extends Controller
{
    public function index(){
        return view('admin/dashboard');
    }
    public function loginForm(){
        return view('admin/auth/login');
    }

    public function registerForm(){
        return view('admin/auth/register');
    }

    public function login(Request $request){
        Validator::make($request->all(), [
            'username' => ['required'],
            'password' => 'required',
        ])->validate();

        $check = $request->all();

        if (Auth::guard('admin')->attempt(['username' => $check['username'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('status', 'Admin login successful');
        } else {
            return back()->with('status', 'Invalid email/username or password');
        }
    }

    public function register(Request $request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:10', 'unique:users'],
            'password' => 'required|confirmed',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        Auth::guard('admin')->login($admin);
        
        return redirect('admin/dashboard');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form')->with('status', 'Admin logged out successfully');
    }
}
