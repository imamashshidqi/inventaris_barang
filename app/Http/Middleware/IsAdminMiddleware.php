<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN apakah dia seorang admin.
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request); // Lanjutkan request ke tujuan
        }

        // Jika bukan admin, redirect ke halaman dashboard atau halaman utama
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses admin.');
    }
}
