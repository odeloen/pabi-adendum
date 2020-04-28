<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(request()->session()->get('pabi_token_api') != ''){
            return $next($request);
        } else {
            return redirect('login')->withErrors('Anda Belum Login!');
        }
    }
}
