<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OperatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user->group_id != 3) {
            return redirect()->route('unauthorized')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        return $next($request);
    }
}
