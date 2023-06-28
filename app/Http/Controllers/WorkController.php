<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\BillOfMaterialSupply;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WorkOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $work = WorkOrder::paginate(25);
        $amount = 0;
        $amounts = array();
        foreach ($work as $wo) {
            foreach ($wo->billOfMaterial->bill_supply as $bm) {
                $amount += $bm->supply->purchase_price * $bm->qty;
            }
            array_push($amounts, $amount);
            $amount = 0;
        }
        return view('Work.index', ['work' => $work, 'amounts' => $amounts]);
    }

    public function create()
    {
        $warehouse = Warehouse::all();
        $bom = BillOfMaterial::all();
        return view('Work.insert', ['warehouse' => $warehouse, 'bom' => $bom]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_wo' => 'required',
            'wo_date' => 'required',
            'information' => 'required',
            'warehouse_id' => 'required',
            'plan_warehouse' => 'required',
            'type' => 'required',
            'qty_result' => 'required',
            'product_name' => 'required',
        ]);

        $bill = BillOfMaterial::where('id', $request->bill_of_material_id)->first();

        WorkOrder::create([
            'no_wo' => $request->no_wo,
            'wo_date' => $request->wo_date,
            'qty' => $bill->qty,
            'information' => $request->information,
            'bill_of_material_id' => $request->bill_of_material_id,
            'warehouse_id' => $request->warehouse_id,
            'plan_warehouse' => $request->plan_warehouse,
            'type' => $request->type,
            'qty_result' => $request->qty_result,
            'amount_cost' => $bill->amount_cost
        ]);

        $bill_of_material_supply = BillOfMaterialSupply::where('bill_of_material_id', $bill->id)->get();

        foreach ($bill_of_material_supply as $b) {
            $b->supply->update([
                'qty' => $b->supply->qty - $b->qty
            ]);
        }

        $product_check = Product::count();
        $last_product = Product::select('product_code')->latest()->first();
        $deleted_string = 'PRO-';
        $newProductCode = ltrim($last_product->product_code, $deleted_string) + 1;

        if($product_check != 0){
            Product::create([
                'product_code' => 'PRO-' . $newProductCode,
                'product_name' => $request->product_name,
                'qty' => $request->qty_result
            ]);
        }else{
            Product::create([
                'product_code' => 'PRO-1',
                'product_name' => $request->product_name,
                'qty' => $request->qty_result
            ]);
        }

        return redirect()->route('workDashboard');
    }

    public function edit($id)
    {
        $work = WorkOrder::where('id', $id)->first();
        $warehouse = Warehouse::all();

        return view('Work.edit', ['work' => $work, 'warehouse' => $warehouse]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_wo' => 'required',
            'wo_date' => 'required',
            'qty' => 'required',
            'information' => 'required',
            'warehouse_id' => 'required',
            'plan_warehouse' => 'required',
            'type' => 'required',
            'qty_result' => 'required',
        ]);

        WorkOrder::where('id', $id)->update([
            'no_wo' => $request->no_wo,
            'wo_date' => $request->wo_date,
            'qty' => $request->qty,
            'information' => $request->information,
            'warehouse_id' => $request->warehouse_id,
            'plan_warehouse' => $request->plan_warehouse,
            'type' => $request->type,
            'qty_result' => $request->qty_result,
        ]);

        return redirect()->route('workDashboard');
    }

    public function delete($id)
    {
        WorkOrder::where('id', $id)->delete();

        return redirect()->route('workDashboard');
    }

    public function printPDF(Request $request)
    {
        if($request->tanggal1 && $request->tanggal2)
        {
            $works = WorkOrder::whereBetween('created_at',[$request->tanggal1,$request->tanggal2])->get();
            $amount = 0;
            $amounts = array();
            foreach ($works as $wo) {
                foreach ($wo->billOfMaterial->bill_supply as $bm) {
                    $amount += $bm->supply->purchase_price * $bm->qty;
                }
                array_push($amounts, $amount);
                $amount = 0;
            }
            $title = 'Laporan Work';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($request->tanggal2));
            $pdf = Pdf::loadView('PDF.work', compact('works', 'title', 'date','date2','amounts'));
        }elseif($request->tanggal1){
            $dateNow = Carbon::now();
            $works = WorkOrder::whereBetween('created_at',[$request->tanggal1,$dateNow])->get();
            $amount = 0;
            $amounts = array();
            foreach ($works as $wo) {
                foreach ($wo->billOfMaterial->bill_supply as $bm) {
                    $amount += $bm->supply->purchase_price * $bm->qty;
                }
                array_push($amounts, $amount);
                $amount = 0;
            }
            $title = 'Laporan Work';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($dateNow));
            $pdf = Pdf::loadView('PDF.work', compact('works', 'title', 'date','date2','amounts'));
        }else{
            $works = WorkOrder::all();
            $amount = 0;
            $amounts = array();
            foreach ($works as $wo) {
                foreach ($wo->billOfMaterial->bill_supply as $bm) {
                    $amount += $bm->supply->purchase_price * $bm->qty;
                }
                array_push($amounts, $amount);
                $amount = 0;
            }
            $title = 'Laporan Work';
            $date = '';
            $date2 = '';
            $pdf = Pdf::loadView('PDF.work', compact('works', 'title','date','date2','amounts'));
        }
        return $pdf->stream('Laporan Work Orders.pdf');
        
    }
}
