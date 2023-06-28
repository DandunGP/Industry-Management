<?php

namespace App\Http\Controllers;

use App\Jobs\UploadOfficerPicture;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'officer_picture' => 'image',
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

        $newUser = User::select('id', 'username')->where('username', '=', $user['username'])->first();

        if($request->officer_picture){
            $filename = 'profile_picture_'. $newUser->username .'.' . $request->officer_picture->getClientOriginalExtension();
            
            Storage::putFileAs('public/picture_queue', $request->officer_picture, $filename);
            $path = 'picture_queue/' . $filename;
            
            $imageQueue = new UploadOfficerPicture($path);
            dispatch($imageQueue);

            $imageUrl = $imageQueue->handle();

            Storage::delete('public/' . $path);
        }

        Officer::create([
            'name' => $officer['name'],
            'nik' => $officer['nik'],
            'date_of_birth' => $officer['dob'],
            'gender' => $officer['gender'],
            'address' => $officer['address'],
            'phone' => $officer['phone'],
            'officer_picture' => $imageUrl ?? "",
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
            'officer_picture' => 'image',
            'position' => 'required|string',
        ]);
        
        $user = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
            'status' => 'required'
        ]);

        $checkOfficer = Officer::with(['user' => function($queryUser){
            $queryUser->select('id', 'username');
        }])->select('user_id', 'officer_picture')->where('id', $id)->first();

        if($request->officer_picture){
            $filename = 'profile_picture_'. $checkOfficer->user->username .'.' . $request->officer_picture->getClientOriginalExtension();
            
            Storage::putFileAs('public/picture_queue', $request->officer_picture, $filename);
            $path = 'picture_queue/' . $filename;
            
            $imageQueue = new UploadOfficerPicture($path);
            dispatch($imageQueue);

            $imageUrl = $imageQueue->handle();

            Storage::delete('public/' . $path);
        }

        Officer::where('id', $id)->update([
            'name' => $officer['name'],
            'nik' => $officer['nik'],
            'date_of_birth' => $officer['dob'],
            'gender' => $officer['gender'],
            'address' => $officer['address'],
            'phone' => $officer['phone'],
            'officer_picture' => $imageUrl ?? $checkOfficer->officer_picture,
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

    public function getOfficer($id){
        $officer = Officer::where('id', $id)->first();

        return view('Officer.detail', ['officer' => $officer]);
    }
}
