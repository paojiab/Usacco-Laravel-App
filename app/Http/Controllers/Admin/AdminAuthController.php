<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use App\Models\ShareProduct;
use App\Models\User;
use App\Models\WelfareProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class AdminAuthController extends Controller
{
    public function index(){
        $monthlyDeposits = SavingTransaction::where('txn_type','deposit')->whereMonth('created_at',now()->month)->get()->sum('amount');
        // $monthlyDeposits = SavingTransaction::where([['txn_type','deposit'],['created_at','>',now()->subDays(30)]])->get()->sum('amount');
        $monthlyWithdraws = SavingTransaction::where('txn_type','withdraw')->whereMonth('created_at',now()->month)->get()->sum('amount');
        $monthlyUsers = User::whereMonth('created_at',now()->month)->get()->count();
        $monthlyAccounts = Account::whereMonth('created_at',now()->month)->get()->count();
        $products = SavingProduct::all();
        $users = User::all();
        $pendingReview = Account::where('status','pending')->get()->count();
        $shareProducts = ShareProduct::all();
        $shareProductCount = $shareProducts->count();
        $welfareProducts = WelfareProduct::all();
        $welfareProductCount = $welfareProducts->count();
        $openLoans = Loan::where('status', 'Open')
        ->orWhere('status','Restructured')
        ->orWhere('status','Defaulted')
        ->get()->count();
        $defaultedLoans = Loan::where('status','Defaulted')->get()->count();
        $loansPendingReviewCount = Loan::where('status','Pending')->get()->count();
        $loanPrdoucts = LoanProduct::all();
        return view('admin/dashboard',compact('monthlyDeposits','monthlyWithdraws','monthlyUsers','monthlyAccounts','products','users','pendingReview','shareProductCount',
    'welfareProducts','welfareProductCount','shareProducts','openLoans','defaultedLoans','loanPrdoucts',
'loansPendingReviewCount'));
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
            return redirect()->route('admin.dashboard');
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
