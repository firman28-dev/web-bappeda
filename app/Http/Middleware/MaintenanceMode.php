<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class MaintenanceMode
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
        $maintenance = Setting::where('key', 'maintenance_mode')->value('value');

        if ($maintenance === 'on') {
            
            $blockedRoutes = [
                'guest.index',
                'guest.news',
                'guest.page-system',
                'guest.showPpid',
                'guest.category-news',
                'guest.pejabat',
                'guest.detail-realisai',
                'guest.get-category',
                'curlListMakro'
            ];

            if ($request->route() && in_array($request->route()->getName(), $blockedRoutes)) {
                return response()->view('maintenance.index');
            }
               
        }
        return $next($request);
    }

        

}
