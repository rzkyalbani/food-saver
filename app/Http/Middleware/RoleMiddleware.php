<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Dapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah peran pengguna ada di dalam daftar peran yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Jika tidak, tolak akses
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        // Jika ya, izinkan akses ke halaman berikutnya
        return $next($request);
    }
}
