<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WelfareProduct;
use Illuminate\Http\Request;

class WelfareProductController extends Controller
{
    public function index(){
        $products = WelfareProduct::all();
        return view('admin.welfare-products',compact('products'));
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'contribution' => 'required'
        ]);

        WelfareProduct::create($fields);
        return redirect()->back()->with('status', 'Welfare product created successfully');
    }
}
