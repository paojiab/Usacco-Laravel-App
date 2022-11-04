<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShareProduct;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index(){
        $shares = ShareProduct::all();
        return view('admin.share-products',compact('shares'));
    }

    public function store(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'minimum' => 'required'
        ]);

        ShareProduct::create($fields);
        return redirect()->back()->with('status', 'Share product created succesfully');
    }
}
