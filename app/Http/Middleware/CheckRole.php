<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param   string $role_title
     * @return mixed
     */
    public function handle($request, Closure $next, $role_title)
    {
        if(empty($request->user()->roles()->where('title',$role_title)->first())) {
            return redirect()
                ->back()
                ->with('message','Invalid Roles');
        }

        return $next($request);
    }
}
