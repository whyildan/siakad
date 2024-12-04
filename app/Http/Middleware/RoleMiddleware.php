<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Memeriksa apakah user terautentikasi dan memiliki role yang valid
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            return redirect('/login'); // Atau bisa redirect ke halaman lain
        }

        return $next($request); // Melanjutkan request ke middleware berikutnya
    }
}
