<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function login(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentials, $request->remember))
        {
            $user = Admin::where('email', $request->email)->first();
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.home');
        } else {
            return redirect()->back('success_message','admin login is failed please try again');
        }
    }

    public function logout()
    {
        if(Auth::guard('admin')->logout())
        {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');
        }
    }
}
