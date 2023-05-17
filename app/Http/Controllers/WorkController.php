<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(){
        $work = WorkOrder::paginate(25);

        return view('Work.index', ['work' => $work]);
    }

    public function create(){
        $warehouse = Warehouse::all();

        return view('Work.insert', ['warehouse' => $warehouse]);
    }

    public function store(Request $request){
        $request->validate([
            'no_wo' => 'required',
            'wo_date' => 'required',
            'qty' => 'required',
            'information' => 'required',
            'warehouse_id' => 'required',
            'plan_warehouse' => 'required',
            'type' => 'required',
            'qty_result' => 'required',
            'amount_cost' => 'required'
        ]);

        WorkOrder::create([
            'no_wo' => $request->no_wo,
            'wo_date' => $request->wo_date,
            'qty' => $request->qty,
            'information' => $request->information,
            'warehouse_id' => $request->warehouse_id,
            'plan_warehouse' => $request->plan_warehouse,
            'type' => $request->type,
            'qty_result' => $request->qty_result,
            'amount_cost' => $request->amount_cost
        ]);

        return redirect()->route('workDashboard');
    }

    public function edit($id){
        $work = WorkOrder::where('id', $id)->first();
        $warehouse = Warehouse::all();

        return view('Work.edit', ['work' => $work, 'warehouse' => $warehouse]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_wo' => 'required',
            'wo_date' => 'required',
            'qty' => 'required',
            'information' => 'required',
            'warehouse_id' => 'required',
            'plan_warehouse' => 'required',
            'type' => 'required',
            'qty_result' => 'required',
            'amount_cost' => 'required'
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
            'amount_cost' => $request->amount_cost
        ]);

        return redirect()->route('workDashboard');
    }

    public function delete($id){
        WorkOrder::where('id', $id)->delete();
        
        return redirect()->route('workDashboard');
    }
}
