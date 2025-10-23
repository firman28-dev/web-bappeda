<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockBadBots
{
    protected $badBots = [
        'kumpulhref', 
        'go-http-client', 
        'gohttpclient', 
        'python-requests', 
        'python requests',
    ];

    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->userAgent() ?? '';
        $ip = $request->ip();

        $uaLower = strtolower($userAgent);

        foreach ($this->badBots as $bot) {
            if (strpos($uaLower, $bot) !== false) {
                Log::warning("Blocked bad bot: {$userAgent} from IP: {$ip}");
                // (Optional) simpan ke tabel blocked_ips
                abort(403, 'Access denied.');
            }
        }

        return $next($request);
    }
}
