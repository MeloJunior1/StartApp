<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdmin
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
        if(\Auth::user()) 
        {
            if(\Auth::user()->admin == 1)
            {
                return $next($request);
            }
        }
        
        
        return redirect()
                ->route('login')
                ->withError(['authorization' => 'Não permitido']);
    }
}
