<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginValidate;
use Illuminate\Support\Facades\Auth;

class OperatorLoginController extends Controller
{
    public function index(){
        return view('Auth/login')->with('data',['route'=>'operator-login','user'=>'Operator-Login']);
    }

    public function login(UserLoginValidate $request){
        
        if(Auth::guard('operator')->attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')])){

            return redirect()->route('operator-dashboard')->setStatusCode(302);
        }

        return redirect()->route('operator-login-show')->withInput()->setStatusCode(302);;
    }

    public function logout(){
        Auth::guard('operator')->logout();
        return redirect('operator/login')->with('data',['route'=>'operator-login','user'=>'Operator-Login']);
    }
}
