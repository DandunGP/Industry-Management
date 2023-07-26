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
            'name' => 'required',
        ]);

        $warehouse = Warehouse::select('*')->orderBy('warehouse_code', 'desc')->first();

        $codeWarehouseInt = substr($warehouse->warehouse_code, 5);

        Warehouse::create([
            'warehouse_code' => "GEPU-" . $codeWarehouseInt + 1,
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
            'name' => 'required',
            'information' => ''
        ]);

        Warehouse::where('id', $id)->update([
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
