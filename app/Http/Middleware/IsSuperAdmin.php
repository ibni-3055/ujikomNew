<?php

namespace App\Http\Middleware;

Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user sudah login DAN memilik role super_admin
        if (auth()->check() && auth()->user()->isSuperAdmin()) {
            return $next($request);
        }

        // Jika bukan super admin, lempar balik ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Hanya Super Admin yang dapat mengelola data Admin.');
    }
}