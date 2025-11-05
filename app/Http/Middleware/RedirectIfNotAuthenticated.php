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
                toastr('Vui lòng đăng nhập với tư cách quản trị viên.', 'warning');
            }
        } else {
            if (!Auth::guard('web')->check()) {
                toastr('Vui lòng đăng nhập để sử dụng chức năng này.', 'warning');
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
