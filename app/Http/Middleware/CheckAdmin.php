<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd("Middleware CheckAdmin đang chạy. URL: " . $request->url());
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user || !$user->is_admin) {
            return redirect('/login');
        }
        return $next($request);
    }
}
