<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        Log::info('Admin middleware is being called.');

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            Log::warning('User is not authenticated or not an admin.');
            abort(403);
        }

        Log::info('User is authenticated and is an admin.');
        return $next($request);
    }
}
