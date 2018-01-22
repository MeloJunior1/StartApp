<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if(strrpos($request->path(), 'admin') === false && \Auth::user()->admin == 0)
        {
            return $next($request);
        }
        else if (strrpos($request->path(), 'admin') > -1 && \Auth::user()->admin == 1)
        {
            return $next($request);
        }
        else 
        {
            return redirect()->back();
        }
    }
}
