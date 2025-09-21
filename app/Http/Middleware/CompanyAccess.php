<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if user has company role
        $user = auth()->user();
        if ($user->role !== 'company' && $user->userType !== 'perusahaan') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Hanya perusahaan yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
