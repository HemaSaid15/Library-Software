<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsLoginUser
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
        // return $next($request);
        // check if sender is login as a User
        if( Auth::check() && Auth::user()->is_admin == 0 )
        {
            return $next($request);
        }

        return redirect( route('books.index') );
    }
}
