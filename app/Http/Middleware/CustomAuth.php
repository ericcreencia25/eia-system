<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class CustomAuth
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
        $path = $request->path();
        if(($path == 'login' && Session::get('data') != null)){
            return redirect('default');
        }
        else if(($path != 'login' && !Session::get('data')) && ($path != 'login-user' && !Session::get('data'))){
            // dd($path);
            // dd(Session::get('data'));
            return redirect('login');
        }

        return $next($request);
    }
}
