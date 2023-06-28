<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\BillOfMaterialSupply;
use App\Models\Supply;
use App\Models\Warehouse;
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
            'no_bom' => 'required',
            'bom_code' => 'required',
            'name' => 'required',
            'information' => '',
            'supply_id' => 'required',
            'warehouse_id' => 'required',
            'type_product' => 'required',
            'qty' => 'required',
            'supply_id' => 'required',
            'qty_supply' => 'required'
        ]);

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
                        return back();
                    }
                }
            }
        }


        $bill = BillOfMaterial::create([
            'no_bom' => $request->no_bom,
            'bom_code' => $request->bom_code,
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
                            return back();
                        }
                    }
                }
            } else {
                foreach ($request->supply_id_old as $key => $supply_id_new) {
                    if ($key == $index_bs) {
                        $bs->update(['supply_id' => $supply_id_new]);
                    }
                }
                foreach ($request->qty_supply_old as $key => $qty_new) {
                    if ($key == $index_bs) {
                        if ($qty_new <= $bs->supply->qty && $qty_new > 0) {
                            $bs->update([
                                'qty' => $qty_new
                            ]);
                        } else {
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
            'no_bom' => $request->no_bom,
            'bom_code' => $request->bom_code,
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
}
