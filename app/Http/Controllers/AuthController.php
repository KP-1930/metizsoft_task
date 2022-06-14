<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;



class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
    
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('user-list')
                        ->with('success','User Logged In successfully');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout() {        
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

}
