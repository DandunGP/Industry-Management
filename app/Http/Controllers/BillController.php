<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\Supply;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bill = BillOfMaterial::paginate(25);

        return view('BOM.index', ['bom' => $bill]);
    }

    public function create()
    {
        $supply = Supply::all();
        $warehouse = Warehouse::all();
        
        return view('BOM.insert', ['supply' => $supply, 'warehouse' => $warehouse]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bom' => 'required',
            'bom_code' => 'required',
            'name' => 'required',
            'information' => '',
            'supply_id' => 'required',
            'warehouse_id' => 'required',
            'type_product' => 'required',
            'qty' => 'required',
            'amount_cost' => 'required',
        ]);

        BillOfMaterial::create([
            'no_bom' => $request->no_bom,
            'bom_code' => $request->bom_code,
            'name' => $request->name,
            'information' => $request->information,
            'supply_id' => $request->supply_id,
            'warehouse_id' => $request->warehouse_id,
            'type_product' => $request->type_product,
            'qty' => $request->qty,
            'amount_cost' => $request->amount_cost
        ]);

        return redirect()->route('billDashboard');
    }

    public function edit($id)
    {
        $bill = BillOfMaterial::where('id', $id)->first();
        $supply = Supply::all();
        $warehouse = Warehouse::all();

        return view('BOM.edit', ['bom' => $bill, 'supply' => $supply, 'warehouse' => $warehouse]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_bom' => 'required',
            'bom_code' => 'required',
            'name' => 'required',
            'information' => '',
            'supply_id' => 'required',
            'warehouse_id' => 'required',
            'type_product' => 'required',
            'qty' => 'required',
            'amount_cost' => 'required',
        ]);

        BillOfMaterial::where('id', $id)->update([
            'no_bom' => $request->no_bom,
            'bom_code' => $request->bom_code,
            'name' => $request->name,
            'information' => $request->information,
            'supply_id' => $request->supply_id,
            'warehouse_id' => $request->warehouse_id,
            'type_product' => $request->type_product,
            'qty' => $request->qty,
            'amount_cost' => $request->amount_cost
        ]);

        return redirect()->route('billDashboard');
    }

    public function delete($id)
    {
        BillOfMaterial::where('id', $id)->delete();

        return redirect()->route('billDashboard');
    }
}
