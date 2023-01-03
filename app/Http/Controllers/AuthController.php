<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        
        $route = Auth::guard('admin')->check() ? route('backend.login') : route('login');
        
        Auth::logout();
        
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->guest($route);
    }    
}