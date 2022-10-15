<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelfareController extends Controller
{
    public function index() {
        return view('usacco/welfare');
    }
}
