<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BothSuperAdminAndAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        if ($user->hasRole('adminsuper') || $user->hasRole('admin')) {
            return $next($request);
        }
        
        return redirect('/dashboard');
    }
}
