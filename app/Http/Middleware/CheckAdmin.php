<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->status == 'Admin') {
            return $next($request);
        }
        
        if(Auth::user()->status == 'Staff'){
            return redirect()->route('staffDashboard');
        }

        if(Auth::user()->status == 'Gudang'){
            return redirect()->route('warehouseDashboard');
        }
    }
}
