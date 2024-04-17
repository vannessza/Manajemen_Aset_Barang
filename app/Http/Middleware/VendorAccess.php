<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorAccess
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        // Cek apakah pengguna adalah admin atau adminsuper
        if ($user->hasRole('admin') || $user->hasRole('adminsuper')) {
            return $next($request);
        }

        return redirect('/dashboard'); // Ganti dengan rute yang sesuai
    }
}
