<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AdminLoginValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function index(){
        return view('Auth/login')->with('data',['route'=>'admin-login','user'=>'Admin-Login']);
    }

    public function login(AdminLoginValidator $request){

        if(Auth::guard('admin')->attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')])){

            return redirect()->route('admin-dashboard')->setStatusCode(302);
        }

        return redirect()->route('admin-login-show')->withInput();
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login')->with('data',['route'=>'admin-login','user'=>'Admin-Login']);
    }
}
