<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        $supply = Supply::paginate(25);

        return view('Supply.index', ['supply' => $supply]);
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('Supply.insert', ['warehouses' => $warehouses]);
    }

    public function store(Request $request)
    {
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
            'warehouse_id' => 'required',
            'qty' => 'required'
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
            'qty' => $request->qty,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'warehouse_id' => $request->warehouse_id,
        ]);

        return redirect()->route('supplyDashboard');
    }

    public function edit($id)
    {
        $supply = Supply::where('id', $id)->first();
        $warehouses = Warehouse::all();
        return view('Supply.edit', ['supply' => $supply, 'warehouses' => $warehouses]);
    }

    public function update(Request $request, $id)
    {
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
            'qty' => 'required'
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
            'qty' => $request->qty,
        ]);

        return redirect()->route('supplyDashboard');
    }

    public function delete($id)
    {
        Supply::where('id', $id)->delete();

        return redirect()->route('supplyDashboard');
    }

    public function printPDF(Request $request)
    {
        $supplys = Supply::all();
        $title = 'Laporan Supply';
        $date = '';
        $date2 = '';
        $pdf = Pdf::loadView('PDF.supply', compact('supplys', 'title','date','date2'));
        
        return $pdf->stream('Laporan Supply.pdf');
    }
}
