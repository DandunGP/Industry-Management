<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view();
    }

    public function create(){
        return view('Product.insert');
    }

    public function store(Request $request){
        $request->validate([
            'product_code' => 'required|string',
            'product_name' => 'required|string',
            'qty' => 'required',
        ]);

        Product::create([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'qty' => $request->qty,
        ]);
    }

    public function edit($id){
        $product = Product::select('*')->where('id', $id)->first();
        return view('Product.edit', ['product' => $product]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_code' => 'required|string',
            'product_name' => 'required|string',
            'qty' => 'required',
        ]);

        Product::where('id', $id)->update([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'qty' => $request->qty,
        ]);
    }

    public function delete($id){
        Product::where('id', $id)->delete();
    }
}
