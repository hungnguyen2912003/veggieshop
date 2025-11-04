<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            if (!Auth::guard('admin')->check()) {
                toastr('Please log in as an admin to access this page.', 'warning');
            }
        } else {
            if (!Auth::guard('web')->check()) {
                toastr('Please log in to use this feature.', 'warning');
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
