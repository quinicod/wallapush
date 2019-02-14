<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class actived
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request)
    {
        if (Auth::user()->actived == 0){
            return view('errors.desactivado');
            
        }else{
            return $next($request);
        }
        
    }
}
