<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    public function index(){
        $officer = Officer::paginate(10);
        return view('Officer.index', ['officer' => $officer]);
    }

    public function create(){
        return view('Officer.insert');
    }

    public function store(Request $request){
        $officer = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|numeric',
            'dob' => 'required',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'position' => 'required|string',
        ]);
        
        $user = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
            'status' => 'required'
        ]);

        User::create([
            'username' => $user['username'],
            'password' => Hash::make($user['password']),
            'status' => $user['status']
        ]);

        $newUser = User::select('id')->where('username', '=', $user['username'])->first();

        Officer::create([
            'name' => $officer['name'],
            'nik' => $officer['nik'],
            'date_of_birth' => $officer['dob'],
            'gender' => $officer['gender'],
            'address' => $officer['address'],
            'phone' => $officer['phone'],
            'position' => $officer['position'],
            'user_id' => $newUser->id,
        ]);

        return redirect()->route('officerDashboard');
    }

    public function edit($id){
        $officer = Officer::select('*')->where('id', $id)->first();
        $user = User::select('*')->where('id', $officer->user_id)->first();
        return view('Officer.edit', [ 'officer' => $officer, 'user' => $user ]);
    }

    public function update(Request $request, $id){
        $officer = $request->validate([
            'name' => 'required|string',
            'nik' => 'required',
            'dob' => 'required',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required',
            'position' => 'required|string',
        ]);
        
        $user = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
            'status' => 'required'
        ]);

        Officer::where('id', $id)->update([
            'name' => $officer['name'],
            'nik' => $officer['nik'],
            'date_of_birth' => $officer['dob'],
            'gender' => $officer['gender'],
            'address' => $officer['address'],
            'phone' => $officer['phone'],
            'position' => $officer['position'],
        ]);

        $officerData = Officer::select('user_id')->where('id', $id)->first();
        User::where('id', $officerData->user_id)->update([
            'username' => $user['username'],
            'password' => Hash::make($user['password']),
            'status' => $user['status'],
        ]);

        return redirect()->route('officerDashboard');
    }

    public function delete($id){
        $officer = Officer::select('user_id')->where('id', $id)->first();
        User::where('id', $officer->user_id)->delete();
        Officer::where('id', $id)->delete();

        return redirect()->route('officerDashboard');
    }
}
