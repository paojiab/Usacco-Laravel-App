<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingProduct;

class SavingProductsController extends Controller
{
    public function index(){
        $products = SavingProduct::all();
        return view('admin/saving-products',compact('products'));
    }

    public function store(Request $request){
        $fields = $request->validate([
            'type' => ['required','unique:saving_products,type'],
            'minimum_balance' => 'required',
            'closing_charge' => 'required',
            'withdraw_charge' => 'required'
        ]);

        SavingProduct::create($fields);

        return redirect()->back()->with('status','Saving product created successfully!');
    }

    public function destroy($id){
        SavingProduct::find($id)->delete();
        return redirect()->back()->with('status','Saving product deleted successfully!');
    }
}
