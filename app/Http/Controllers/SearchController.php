<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\Incoming;
use App\Models\Officer;
use App\Models\Product;
use App\Models\Supply;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchOfficer(Request $request){
        if ($request->has('keyword')) {
            $data = Officer::where('name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('date_of_birth', 'LIKE', "%{$request->keyword}%")
                ->orWhere('gender', 'LIKE', "%{$request->keyword}%")
                ->orWhere('address', 'LIKE', "%{$request->keyword}%")
                ->orWhere('phone', 'LIKE', "%{$request->keyword}%")
                ->orWhere('position', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = Officer::paginate(25);
        }

        return view('Officer.index', ['officer' => $data]);
    }

    public function searchUserStaff(Request $request){
        if ($request->has('keyword')) {
            $data = User::where('username', 'LIKE', "%{$request->keyword}%")
                ->orWhere('status', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = User::where('status', 'Staff')->paginate(25);
        }

        return view('User.Staff.index', ['user' => $data]);
    }

    public function searchUserWarehouse(Request $request){
        if ($request->has('keyword')) {
            $data = User::where('username', 'LIKE', "%{$request->keyword}%")
                ->orWhere('status', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = User::where('status', 'Gudang')->paginate(25);
        }

        return view('User.Gudang.index', ['user' => $data]);
    }

    public function searchWarehouse(Request $request){
        if ($request->has('keyword')) {
            $data = Warehouse::where('warehouse_code', 'LIKE', "%{$request->keyword}%")
                ->orWhere('name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('information', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = Warehouse::paginate(25);
        }
        
        return view('Gudang.index', ['warehouse' => $data]);
    }

    public function searchProduct(Request $request){
        if ($request->has('keyword')) {
            $data = Product::where('product_code', 'LIKE', "%{$request->keyword}%")
                ->orWhere('product_name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('qty', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = Product::paginate(25);
        }
        
        return view('Product.index', ['product' => $data]);
    }

    public function searchIncoming(Request $request){
        if ($request->has('keyword')) {
            $data = Incoming::where('no_bpb', 'LIKE', "%{$request->keyword}%")
                ->orWhere('no_po', 'LIKE', "%{$request->keyword}%")
                ->orWhere('po_date', 'LIKE', "%{$request->keyword}%")
                ->orWhere('supplier', 'LIKE', "%{$request->keyword}%")
                ->orWhere('address', 'LIKE', "%{$request->keyword}%")
                ->orWhere('no_sj_supplier', 'LIKE', "%{$request->keyword}%")
                ->orWhere('qty', 'LIKE', "%{$request->keyword}%")
                ->orWhere('information', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = Incoming::paginate(25);
        }

        return view('Incoming.index', ['incoming' => $data]);
    }

    public function searchSupply(Request $request){
        if ($request->has('keyword')) {
            $data = Supply::where('supply_code', 'LIKE', "%{$request->keyword}%")
                ->orWhere('name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('type', 'LIKE', "%{$request->keyword}%")
                ->orWhere('category', 'LIKE', "%{$request->keyword}%")
                ->orWhere('merk', 'LIKE', "%{$request->keyword}%")
                ->orWhere('memo', 'LIKE', "%{$request->keyword}%")
                ->orWhere('part_number', 'LIKE', "%{$request->keyword}%")
                ->orWhere('status', 'LIKE', "%{$request->keyword}%")
                ->orWhere('purchase_price', 'LIKE', "%{$request->keyword}%")
                ->orWhere('selling_price', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = Supply::paginate(25);
        }

        return view('Supply.index', ['supply' => $data]);
    }

    public function searchBill(Request $request){
        if ($request->has('keyword')) {
            $data = BillOfMaterial::where('no_bom', 'LIKE', "%{$request->keyword}%")
                ->orWhere('bom_code', 'LIKE', "%{$request->keyword}%")
                ->orWhere('name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('information', 'LIKE', "%{$request->keyword}%")
                ->orWhere('warehouse_id', 'LIKE', "%{$request->keyword}%")
                ->orWhere('type_product', 'LIKE', "%{$request->keyword}%")
                ->orWhere('qty', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = BillOfMaterial::paginate(25);
        }

        $amount = 0;
        $amounts = array();
        foreach ($data as $bom) {
            foreach ($bom->bill_supply as $bm) {
                $amount += $bm->supply->purchase_price * $bm->qty;
            }
            array_push($amounts, $amount);
            $amount = 0;
        }

        return view('BOM.index', ['bom' => $data, 'amounts' => $amounts]);
    }

    public function searchWork(Request $request){
        if ($request->has('keyword')) {
            $data = WorkOrder::where('no_wo', 'LIKE', "%{$request->keyword}%")
                ->orWhere('qty', 'LIKE', "%{$request->keyword}%")
                ->orWhere('information', 'LIKE', "%{$request->keyword}%")
                ->orWhere('type', 'LIKE', "%{$request->keyword}%")
                ->orWhere('qty_result', 'LIKE', "%{$request->keyword}%")
                ->paginate(25);
        } else {
            $data = WorkOrder::paginate(25);
        }

        $amount = 0;
        $amounts = array();
        foreach ($data as $wo) {
            foreach ($wo->billOfMaterial->bill_supply as $bm) {
                $amount += $bm->supply->purchase_price * $bm->qty;
            }
            array_push($amounts, $amount);
            $amount = 0;
        }

        return view('Work.index', ['work' => $data, 'amounts' => $amounts]);
    }
}
