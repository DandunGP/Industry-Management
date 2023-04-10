<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index(){
        return view();
    }

    public function create(){
        return view('Admin.Incoming.insert');
    }

    public function store(Request $request){
        $request->validate([
            'no_po' => 'required|string' ,
            'po_date' => 'required' ,
            'date_of_receipt' => 'required',
            'supplier' => 'required',
            'address' => 'required|string',
            'no_sj_supplier' => 'required|string',
            'qty' => 'required',
            'information' => 'required',
        ]);

        Incoming::create([
            'no_po' => $request->no_po ,
            'po_date' => $request->po_date ,
            'date_of_receipt' => $request->date_of_receipt,
            'supplier' => $request->supplier,
            'address' => $request->address,
            'no_sj_supplier' => $request->no_sj_supplier,
            'qty' => $request->qty,
            'information' => $request->information,
        ]);
    }

    public function edit($id){
        $incoming = Incoming::select('*')->where('id', $id)->first();
        return view('Admin.Incoming.edit', ['incoming' => $incoming]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_po' => 'required|string' ,
            'po_date' => 'required' ,
            'date_of_receipt' => 'required',
            'supplier' => 'required',
            'address' => 'required|string',
            'no_sj_supplier' => 'required|string',
            'qty' => 'required',
            'information' => 'required',
        ]);

        Incoming::where('id', $id)->update([
            'no_po' => $request->no_po ,
            'po_date' => $request->po_date ,
            'date_of_receipt' => $request->date_of_receipt,
            'supplier' => $request->supplier,
            'address' => $request->address,
            'no_sj_supplier' => $request->no_sj_supplier,
            'qty' => $request->qty,
            'information' => $request->information,
        ]);
    }

    public function delete($id){
        Incoming::where('id', $id)->delete();
    }
}
