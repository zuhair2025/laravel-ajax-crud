<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $auth = Auth::user();
        if(!auth()->check() || !auth()->user()->type == 'admin')
        {
//            return redirect()->to('/login');
            abort(403);

        }
        return $next($request);
    }
}
