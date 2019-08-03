<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Loginnavigate
{
 
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check() || Auth::guard('operator')->check() || Auth::guard('lecturer')->check()){
            if(Auth::guard('admin')->check()){
                return redirect()->route('admin-dashboard');
            }
            if(Auth::guard('operator')->check()){
                return redirect()->route('operator-dashboard');
            }
            if(Auth::guard('lecturer')->check()){
                return redirect()->route('lecturer-dashboard');
            }
            
        }
        return $next($request);
    }
}
