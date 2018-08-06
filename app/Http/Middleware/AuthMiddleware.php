<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        $path=explode('/',$request->getPathInfo());
        if(\Auth::guard($guard)->check()) {
            if (\Auth::user()->roles[0]->name == ucfirst($path[1])) {
                return $next($request);
            }else if(\Auth::user()->roles[0]->name == "Buyer And Seller"){
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
