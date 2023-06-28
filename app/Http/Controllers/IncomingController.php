<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use App\Models\Supply;
use App\Models\Warehouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index()
    {
        $incoming = Incoming::paginate(25);

        return view('Incoming.index', ['incoming' => $incoming]);
    }

    public function create()
    {
        $supply = Supply::all();
        $warehouses = Warehouse::all();
        return view('Incoming.insert',compact('supply','warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bpb' => 'required|string',
            'no_po' => 'required|string',
            'po_date' => 'required',
            'date_of_receipt' => 'required',
            'address' => 'required|string',
            'supplier' => 'required',
            'no_sj_supplier' => 'required|string',
            'qty' => 'required',
            'information' => 'required',
        ]);

        if($request->id_supply){
            $incoming = Incoming::create([
                'no_bpb' => $request->no_bpb,
                'no_po' => $request->no_po,
                'po_date' => $request->po_date,
                'date_of_receipt' => $request->date_of_receipt,
                'supply_id' => $request->id_supply,
                'supplier' => $request->supplier,
                'address' => $request->address,
                'no_sj_supplier' => $request->no_sj_supplier,
                'qty' => $request->qty,
                'information' => $request->information,
            ]);
            $incoming->supply->update([
                'qty' => $incoming->supply->qty + $request->qty
            ]);
        }else{
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
    
            $supply = Supply::create([
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

            Incoming::create([
                'no_bpb' => $request->no_bpb,
                'no_po' => $request->no_po,
                'po_date' => $request->po_date,
                'date_of_receipt' => $request->date_of_receipt,
                'supply_id' => $supply->id,
                'supplier' => $request->supplier,
                'address' => $request->address,
                'no_sj_supplier' => $request->no_sj_supplier,
                'qty' => $request->qty,
                'information' => $request->information,
            ]);
        }


        return redirect()->route('incomingDashboard');
    }

    public function edit($id)
    {
        $incoming = Incoming::select('*')->where('id', $id)->first();
        return view('Incoming.edit', ['incoming' => $incoming]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_bpb' => 'required|string',
            'no_po' => 'required|string',
            'po_date' => 'required',
            'date_of_receipt' => 'required',
            'supplier' => 'required',
            'address' => 'required|string',
            'no_sj_supplier' => 'required|string',
            'qty' => 'required',
            'information' => 'required',
        ]);

        Incoming::where('id', $id)->update([
            'no_bpb' => $request->no_bpb,
            'no_po' => $request->no_po,
            'po_date' => $request->po_date,
            'date_of_receipt' => $request->date_of_receipt,
            'supplier' => $request->supplier,
            'address' => $request->address,
            'no_sj_supplier' => $request->no_sj_supplier,
            'qty' => $request->qty,
            'information' => $request->information,
        ]);

        return redirect()->route('incomingDashboard');
    }


    public function printPDF(Request $request)
    {
        if($request->tanggal1 && $request->tanggal2)
        {
            $incomings = Incoming::whereBetween('po_date',[$request->tanggal1,$request->tanggal2])->get();
            $title = 'Laporan Barang Masuk';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($request->tanggal2));
            $pdf = Pdf::loadView('PDF.incoming', compact('incomings', 'title', 'date','date2'));
        }elseif($request->tanggal1){
            $dateNow = Carbon::now();
            $incomings = Incoming::whereBetween('po_date',[$request->tanggal1,$dateNow])->get();
            $title = 'Laporan Barang Masuk';
            $date = date('j F Y', strtotime($request->tanggal1));
            $date2 = date('j F Y', strtotime($dateNow));
            $pdf = Pdf::loadView('PDF.incoming', compact('incomings', 'title', 'date','date2'));
        }else{
            $incomings = Incoming::all();
            $title = 'Laporan Barang Masuk';
            $date = '';
            $date2 = '';
            $pdf = Pdf::loadView('PDF.incoming', compact('incomings', 'title','date','date2'));
        }
        return $pdf->stream('Laporan Barang Masuk.pdf');
    }
}
