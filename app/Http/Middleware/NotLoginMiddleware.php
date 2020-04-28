<?php

namespace App\Http\Middleware;

use Closure;

class NotLoginMiddleware
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
        if(session('pabi_token_api') !== null){
            if (session('pabi_role_id') == 4) {
                return redirect('member');
            } else {
                return redirect('admin');
            }
        } else {
            return $next($request);
        }
    }
}
