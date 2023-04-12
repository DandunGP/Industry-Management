<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index(){
        $supply = Supply::paginate(25);
    
        return view('Supply.index', ['supply' => $supply]);
    }

    public function create(){
        return view('Supply.insert');
    }

    public function store(Request $request){
        $request->validate([
            'supply_code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'category' => 'required',
            'merk' => 'required',
            'memo' => 'required',
            'part_number' => 'required',
            'status' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);

        Supply::create([
            'supply_code' => $request->supply_code,
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'merk' => $request->merk,
            'memo' => $request->memo,
            'part_number' => $request->part_number,
            'status' => $request->status,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect()->route('supplyDashboard');
    }

    public function edit($id){
        $supply = Supply::where('id', $id)->first();

        return view('Supply.edit', ['supply' => $supply]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'supply_code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'category' => 'required',
            'merk' => 'required',
            'memo' => 'required',
            'part_number' => 'required',
            'status' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);

        Supply::where('id', $id)->update([
            'supply_code' => $request->supply_code,
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'merk' => $request->merk,
            'memo' => $request->memo,
            'part_number' => $request->part_number,
            'status' => $request->status,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect()->route('supplyDashboard');
    }

    public function delete($id){
        Supply::where('id', $id)->delete();
        
        return redirect()->route('supplyDashboard');
    }
}
