<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\Warehouse;
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
}
