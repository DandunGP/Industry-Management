<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authentication(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $user = User::where('username', $credentials['username'])->first();
                if($user->status == 'Admin'){
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                }else{
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                }
        }

        session()->flash('alert.message', "username dan password anda salah");

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
