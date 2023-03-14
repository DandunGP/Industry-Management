<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    public function index(){
        return view();
    }

    public function create(){
        return view('Admin.Officer.insert');
    }

    public function store(Request $request){
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
            'password' => 'required'
        ]);

        User::create([
            'username' => $user['username'],
            'password' => Hash::make($user['password']),
            'status' => $officer['position']
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
    }

    public function edit($id){
        $officer = Officer::select('*')->where('id', $id)->first();
        $user = User::select('*')->where('id', $officer->user_id)->first();
        return view('Admin.Officer.edit', [ 'officer' => $officer, 'user' => $user ]);
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
            'password' => 'required'
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
            'status' => $officer['position'],
        ]);
    }

    public function delete($id){
        $officer = Officer::select('user_id')->where('id', $id)->first();
        Officer::where('id', $id)->delete();
        User::where('id', $officer->user_id)->delete();
    }
}
