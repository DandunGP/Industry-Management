<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\BillOfMaterialSupply;
use App\Models\Supply;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bill = BillOfMaterial::paginate(25);
        $amount = 0;
        $amounts = array();
        foreach ($bill as $bom) {
            foreach ($bom->bill_supply as $bm) {
                $amount += $bm->supply->purchase_price * $bm->qty;
            }
            array_push($amounts, $amount);
            $amount = 0;
        }

        return view('BOM.index', ['bom' => $bill, 'amounts' => $amounts]);
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
            'name' => 'required',
            'information' => '',
            'supply_id' => 'required',
            'warehouse_id' => 'required',
            'type_product' => 'required',
            'qty' => 'required',
            'supply_id' => 'required',
            'qty_supply' => 'required'
        ]);

        $noBomLast = BillOfMaterial::orderBy('no_bom', 'desc')->first();
        if($noBomLast){
            $noBomInt = substr($noBomLast->no_bom, 5);

            $bomCodeLast = BillOfMaterial::orderBy('bom_code', 'desc')->first();
            $bomCodeInt = substr($bomCodeLast->bom_code, 3);
    
            $supply_array = array();
    
            foreach ($request->supply_id as $supply) {
                $supplies = Supply::where('id', $supply)->first();
                array_push($supply_array, $supplies->id);
            }
    
            foreach ($supply_array as $index => $sp) {
                foreach ($request->qty_supply as $index_sp => $qty_sp) {
                    if ($index_sp == $index) {
                        $sp_qty = Supply::where('id', $sp)->first();
                        if ($sp_qty->qty < $qty_sp) {
                            session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupi");
                            session()->flash('alert.type', "failed");
                            
                            return back();
                        }
                    }
                }
            }
    
            $bill = BillOfMaterial::create([
                'no_bom' => 'BILL-' . $noBomInt + 1,
                'bom_code' => 'BC-'. $bomCodeInt + 1,
                'name' => $request->name,
                'information' => $request->information,
                'warehouse_id' => $request->warehouse_id,
                'type_product' => $request->type_product,
                'qty' => $request->qty,
            ]);
    
    
            foreach ($request->supply_id as $index => $supply) {
                foreach ($request->qty_supply as $index_supply => $qty) {
                    if ($index_supply == $index) {
                        BillOfMaterialSupply::create([
                            'bill_of_material_id' => $bill->id,
                            'supply_id' => $supply,
                            'qty' => $qty
                        ]);
                    }
                }
            }
    
            return redirect()->route('billDashboard');
        }else{
            $supply_array = array();
    
            foreach ($request->supply_id as $supply) {
                $supplies = Supply::where('id', $supply)->first();
                array_push($supply_array, $supplies->id);
            }
    
            foreach ($supply_array as $index => $sp) {
                foreach ($request->qty_supply as $index_sp => $qty_sp) {
                    if ($index_sp == $index) {
                        $sp_qty = Supply::where('id', $sp)->first();
                        if ($sp_qty->qty < $qty_sp) {
                            session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupi");
                            session()->flash('alert.type', "failed");
                            
                            return back();
                        }
                    }
                }
            }
    
    
            $bill = BillOfMaterial::create([
                'no_bom' => 'BILL-1',
                'bom_code' => 'BC-1',
                'name' => $request->name,
                'information' => $request->information,
                'warehouse_id' => $request->warehouse_id,
                'type_product' => $request->type_product,
                'qty' => $request->qty,
            ]);
    
    
            foreach ($request->supply_id as $index => $supply) {
                foreach ($request->qty_supply as $index_supply => $qty) {
                    if ($index_supply == $index) {
                        BillOfMaterialSupply::create([
                            'bill_of_material_id' => $bill->id,
                            'supply_id' => $supply,
                            'qty' => $qty
                        ]);
                    }
                }
            }
    
            return redirect()->route('billDashboard');
        }
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
            'name' => 'required',
            'information' => '',
            'warehouse_id' => 'required',
            'type_product' => 'required',
            'qty' => 'required',
        ]);

        $bill_supply = BillOfMaterialSupply::where('bill_of_material_id', $id)->get();

        foreach ($bill_supply as $index_bs => $bs) {
            if (in_array($bs->supply_id, $request->supply_id_old)) {
                foreach ($request->qty_supply_old as $key => $qty_new) {
                    if ($key == $index_bs) {
                        if ($qty_new <= $bs->supply->qty && $qty_new > 0) {
                            $bs->update([
                                'qty' => $qty_new
                            ]);
                        } else {
                            session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupi");
                            session()->flash('alert.type', "failed");
                            
                            return back();
                        }
                    }
                }
            } else {
                foreach ($request->supply_id_old as $key => $supply_id_new) {
                    if ($key == $index_bs) {
                        $checkQty = Supply::where('id', $supply_id_new)->first();
                        foreach ($request->qty_supply_old as $key => $qty_new) {
                            if ($key == $index_bs) {
                                if($checkQty->qty < $qty_new){
                                    session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupi");
                                    session()->flash('alert.type', "failed");
                                    
                                    return back();
                                }

                                $bs->update(['supply_id' => $supply_id_new]);
                            }
                        }
                    }
                }
                foreach ($request->qty_supply_old as $key => $qty_new) {
                    if ($key == $index_bs) {
                        if ($qty_new <= $bs->supply->qty && $qty_new > 0) {
                            $bs->update([
                                'qty' => $qty_new
                            ]);
                        } else {
                            session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupiss");
                            session()->flash('alert.type', "failed");
                            
                            return back();
                        }
                    }
                }
            }
        }

        if ($request->supply_id) {
            $supply_array = array();

            foreach ($request->supply_id as $supply) {
                $supplies = Supply::where('id', $supply)->first();
                array_push($supply_array, $supplies->id);
            }

            foreach ($supply_array as $index => $sp) {
                foreach ($request->qty_supply as $index_sp => $qty_sp) {
                    if ($index_sp == $index) {
                        $sp_qty = Supply::where('id', $sp)->first();
                        if ($sp_qty->qty < $qty_sp) {
                            session()->flash('alert.message', "persediaan barang yang digunakan tidak mencukupi");
                            session()->flash('alert.type', "failed");
                            
                            return back();
                        }
                    }
                }
            }

            foreach ($request->supply_id as $index => $supply) {
                foreach ($request->qty_supply as $index_supply => $qty) {
                    if ($index_supply == $index) {
                        BillOfMaterialSupply::create([
                            'bill_of_material_id' => $id,
                            'supply_id' => $supply,
                            'qty' => $qty
                        ]);
                    }
                }
            }
        }


        BillOfMaterial::where('id', $id)->update([
            'name' => $request->name,
            'information' => $request->information,
            'warehouse_id' => $request->warehouse_id,
            'type_product' => $request->type_product,
            'qty' => $request->qty,
        ]);

        return redirect()->route('billDashboard');
    }

    public function delete($id)
    {
        $bill_supply = BillOfMaterialSupply::where('bill_of_material_id', $id)->get();
        foreach ($bill_supply as $item) {
            $item->delete();
        }
        BillOfMaterial::where('id', $id)->delete();

        return redirect()->route('billDashboard');
    }

    public function deleteSupply($id)
    {
        $bill_supply = BillOfMaterialSupply::where('id', $id)->first();
        $bill_supply->delete();
        return back();
    }

    public function printPDF(Request $request)
    {
        if($request->tanggal1 && $request->tanggal2)
        {
            $bom = BillOfMaterial::whereBetween('created_at',[$request->tanggal1,$request->tanggal2])->get();
            $title = 'Laporan Bill Of Material';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($request->tanggal2));
            $pdf = Pdf::loadView('PDF.bill', compact('bom', 'title', 'date','date2','amounts'));
        }elseif($request->tanggal1){
            $dateNow = Carbon::now();
            $bom = BillOfMaterial::whereBetween('created_at',[$request->tanggal1,$dateNow])->get();
            $title = 'Laporan Bill Of Material';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($dateNow));
            $pdf = Pdf::loadView('PDF.bill', compact('bom', 'title', 'date','date2','amounts'));
        }else{
            $bom = BillOfMaterial::all();
            $date = '';
            $date2 = '';
            $pdf = Pdf::loadView('PDF.bill', compact('bom', 'title','date','date2','amounts'));
        }
        return $pdf->stream('Laporan Bill Of Material Orders.pdf');
        
    }
}
