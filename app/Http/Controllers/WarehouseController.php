<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(){
        $warehouse = Warehouse::paginate(10);

        return view('Gudang.index', ['warehouse' => $warehouse]);
    }

    public function create(){
        return view('Gudang.insert');
    }

    public function store(Request $request){
        $request->validate([
            'warehouse_code' => 'required',
            'name' => 'required',
        ]);

        Warehouse::create([
            'warehouse_code' => "GEPU-" . $request->warehouse_code,
            'name' => $request->name,
            'information' => $request->information
        ]);

        return redirect()->route('dashboardWarehouse');
    }

    public function edit($id){
        $warehouse = Warehouse::select('*')->where('id', $id)->first();

        return view('Gudang.edit', ['warehouse' => $warehouse]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'warehouse_code' => 'required',
            'name' => 'required',
            'information' => ''
        ]);

        Warehouse::where('id', $id)->update([
            'warehouse_code' => "GEPU-" . $request->warehouse_code,
            'name' => $request->name,
            'information' => $request->information
        ]);

        return redirect()->route('dashboardWarehouse');
    }

    public function delete($id){
        Warehouse::where('id', $id)->delete();

        return redirect()->route('dashboardWarehouse');
    }
}
