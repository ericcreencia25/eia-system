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
        $paths = explode("/",$path);

        if(($paths[0] == 'login' && Session::get('data') != null) || ($paths[0] == 'welcome' && Session::get('data') != null)){
            return redirect('default');
        }else if(
            ($paths[0] != 'login' && !Session::get('data')) && 
            ($paths[0] != 'login-user' && !Session::get('data')) && 
            ($paths[0] != 'welcome' && !Session::get('data'))){
            return redirect('welcome');
        }


        return $next($request);
    }
}
