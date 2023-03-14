<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(){
        return view();
    }

    public function create(){
        return view('Admin.Warehouse.insert');
    }

    public function store(Request $request){
        $request->validate([
            'warehouse_code' => 'required',
            'name' => 'required',
        ]);

        Warehouse::create([
            'warehouse_code' => $request->warehouse_code,
            'name' => $request->name,
            'information' => $request->information
        ]);
    }

    public function edit(){
        return view('Admin.Warehouse.edit');
    }

    public function update(){

    }

    public function delete(){

    }
}
