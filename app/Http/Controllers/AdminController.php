<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $countUser = User::where('status', 'Staff')->whereOr('status', 'Gudang')->count();
        $countOfficer = Officer::count();

        // $income = Sale::where

        // $outcome = 

        return view('dashboard', ['countUser' => $countUser, 'countOfficer' =>  $countOfficer]);
    }

    public function getUserStaff(){
        $user = User::where('status', 'Staff')->paginate(10);
        
        return view('User.Staff.index', ['user' => $user]);
    }

    public function editUserStaff($id){
        $user = User::where('id', $id)->first();

        return view('User.Staff.edit', ['user' => $user]);
    }

    public function updateUserStaff(Request $request, $id){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
            'status' => 'required'
        ]);

        User::where('id', $id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        return redirect()->route('staffDashboard');
    }

    public function getUserWarehouse(){
        $user = User::where('status', 'Gudang')->paginate(10);
        
        return view('User.Gudang.index', ['user' => $user]);
    }

    public function editUserWarehouse($id){
        $user = User::where('id', $id)->first();

        return view('User.Gudang.edit', ['user' => $user]);
    }

    public function updateUserWarehouse(Request $request, $id){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
            'status' => 'required'
        ]);

        User::where('id', $id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        return redirect()->route('warehouseDashboard');
    }
}
