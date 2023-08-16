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
            'information' => 'required',
            'plan_warehouse' => 'required',
            'qty_result' => 'required',
            'product_name' => 'required',
        ]);
        
        $woLast = WorkOrder::orderBy('no_wo', 'desc')->first();
        if($woLast){
            $woLastInt = substr($woLast->no_wo, 3);

            $bill = BillOfMaterial::where('id', $request->bill_of_material_id)->first();
    
            WorkOrder::create([
                'no_wo' => "WO-" . $woLastInt + 1,
                'qty' => $bill->qty,
                'information' => $request->information,
                'bill_of_material_id' => $request->bill_of_material_id,
                'warehouse_id' => $bill->warehouse_id,
                'plan_warehouse' => $request->plan_warehouse,
                'type' => $bill->type_product,
                'qty_result' => $request->qty_result,
                'amount_cost' => $bill->amount_cost
            ]);
    
            $bill_of_material_supply = BillOfMaterialSupply::where('bill_of_material_id', $bill->id)->get();
    
            //check qty supply
            foreach ($bill_of_material_supply as $b) {
                if($b->supply->qty < $bill->qty){
                    session()->flash('alert.message', "jumlah bahan yang tersedia untuk digunakan tidak mencukupi");
                    session()->flash('alert.type', "failed");

                    $warehouse = Warehouse::all();
                    $bom = BillOfMaterial::all();
                    return view('Work.insert', ['warehouse' => $warehouse, 'bom' => $bom]);
                }
            }
            
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
                $product_exist = Product::where('product_name', $request->product_name)->first();
                if($product_exist){
                    $product_exist->update([
                        'qty' => $product_exist->qty + $request->qty_result
                    ]);
                }else{
                    Product::create([
                        'product_code' => 'PRO-' . $newProductCode,
                        'product_name' => $request->product_name,
                        'qty' => $request->qty_result
                    ]);
                }
            }else{
                Product::create([
                    'product_code' => 'PRO-1',
                    'product_name' => $request->product_name,
                    'qty' => $request->qty_result
                ]);
            }
    
            return redirect()->route('workDashboard');
        }else{
            $bill = BillOfMaterial::where('id', $request->bill_of_material_id)->first();
            
            WorkOrder::create([
                'no_wo' => "WO-1",
                'qty' => $bill->qty,
                'information' => $request->information,
                'bill_of_material_id' => $request->bill_of_material_id,
                'warehouse_id' => $bill->warehouse_id,
                'plan_warehouse' => $request->plan_warehouse,
                'type' => $bill->type_product,
                'qty_result' => $request->qty_result,
                'amount_cost' => $bill->amount_cost
            ]);
    
            $bill_of_material_supply = BillOfMaterialSupply::where('bill_of_material_id', $bill->id)->get();
    
            //check qty supply
            foreach ($bill_of_material_supply as $b) {
                if($b->supply->qty < $bill->qty){
                    session()->flash('alert.message', "jumlah bahan yang tersedia untuk digunakan tidak mencukupi");
                    session()->flash('alert.type', "failed");

                    $warehouse = Warehouse::all();
                    $bom = BillOfMaterial::all();
                    return view('Work.insert', ['warehouse' => $warehouse, 'bom' => $bom]);
                }
            }

            foreach ($bill_of_material_supply as $b) {
                $b->supply->update([
                    'qty' => $b->supply->qty - $b->qty
                ]);
            }
    
            $product_check = Product::count();
    
            if($product_check != 0){
                $last_product = Product::select('product_code')->latest()->first();
                $deleted_string = 'PRO-';
                $newProductCode = ltrim($last_product->product_code, $deleted_string) + 1;
                
                $product_exist = Product::where('product_name', $request->product_name)->first();
                if($product_exist){
                    $product_exist->update([
                        'qty' => $product_exist->qty + $request->qty_result
                    ]);
                }else{
                    Product::create([
                        'product_code' => 'PRO-' . $newProductCode,
                        'product_name' => $request->product_name,
                        'qty' => $request->qty_result
                    ]);
                }
            }else{
                Product::create([
                    'product_code' => 'PRO-1',
                    'product_name' => $request->product_name,
                    'qty' => $request->qty_result
                ]);
            }
    
            return redirect()->route('workDashboard');
        }
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
            'information' => 'required',
            'plan_warehouse' => 'required',
            'qty_result' => 'required',
        ]);

        WorkOrder::where('id', $id)->update([
            'information' => $request->information,
            'plan_warehouse' => $request->plan_warehouse,
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
            dd($amounts);
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
            dd($amounts);
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
