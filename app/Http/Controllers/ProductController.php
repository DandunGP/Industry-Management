<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::paginate(25);

        return view('Product.index', ['product' => $product]);
    }

    public function create()
    {
        return view('Product.insert');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'qty' => 'required',
        ]);

        $product_last = Product::orderBy('product_code', 'desc')->first();
        $productCodeInt = substr($product_last->product_code, 4);

        Product::create([
            'product_code' => "PRO-" . $productCodeInt + 1,
            'product_name' => $request->product_name,
            'qty' => $request->qty,
        ]);

        return redirect()->route('productDashboard');
    }

    public function edit($id)
    {
        $product = Product::select('*')->where('id', $id)->first();
        return view('Product.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string',
            'qty' => 'required',
        ]);

        Product::where('id', $id)->update([
            'product_name' => $request->product_name,
            'qty' => $request->qty,
        ]);

        return redirect()->route('productDashboard');
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();

        return redirect()->route('productDashboard');
    }

    public function printPDF(Request $request)
    {
        $products = Product::where('created_at', 'LIKE', '%' . $request->tanggal . '%')->get();
        $title = 'Laporan Produk';
        $date = date('j F Y', strtotime($request->tanggal));
        $pdf = Pdf::loadView('PDF.product', compact('products', 'title', 'date'));
        return $pdf->stream('Laporan Produk.pdf');
    }
}
