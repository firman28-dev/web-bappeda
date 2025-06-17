<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

class TrackVisitor
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
        if (
            $request->is('/') ||
            $request->is('home/detail-realisasi') ||
            $request->is('home/get-category-bidang/*') ||
            $request->is('home/show-news/*') ||
            $request->is('home/pages/*') ||
            $request->is('home/ppid/*') ||
            $request->is('profile/profile-pejabat') ||
            $request->is('home/category/*')
        ) {
            DB::table('visitor_stats')->insert([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'visited_at' => now()
            ]);
        }
        // if ($request->is('/')) {
        //     DB::table('visitor_stats')->insert([
        //         'ip_address' => $request->ip(),
        //         'user_agent' => $request->header('User-Agent'),
        //         'visited_at' => now()
        //     ]);
        // }

        return $next($request);
    }
}
