<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(){
        return view('admin.finance');
    }

    public function monthlyCashflow(){
        return view('admin.monthly_cashflow');
    }
}
