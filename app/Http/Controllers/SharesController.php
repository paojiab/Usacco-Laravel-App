<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharesController extends Controller
{
    public function index() {
        return view('usacco/shares');
    }
}
