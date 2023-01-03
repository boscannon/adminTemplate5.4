<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->status == '1'){
            return $next($request);
        }
        

        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        
        abort(403, __('user disabled'));
    }
}
