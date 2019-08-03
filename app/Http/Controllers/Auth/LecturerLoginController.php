<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LecturerLoginValidate;

class LecturerLoginController extends Controller
{
    public function index(){
        return view('Auth/login')->with('data',['route'=>'lecturer-login','user'=>'Lecturer-Login']);
    }

    public function login(LecturerLoginValidate $request){
        
        if(Auth::guard('lecturer')->attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')])){

            return redirect()->route('lecturer-dashboard');
        }

        return redirect()->route('lecturer-login-show')->withInput()->withErrors();
    }

    public function logout(){
        Auth::guard('lecturer')->logout();
        return redirect('lecturer/login')->with('data',['route'=>'lecturer-login','user'=>'Lecturer-Login']);
    }
}
