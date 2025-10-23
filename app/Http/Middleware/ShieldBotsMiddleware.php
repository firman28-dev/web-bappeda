<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ShieldBotsMiddleware
{
    protected $limiter;
    protected $banTime = 3600; // detik (1 jam)

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next)
    {
        $ip  = $request->ip();
        $ua  = strtolower($request->userAgent() ?? '');
        $key = 'bot:'.$ip.':'.md5($ua);

        // --- Jika IP sudah di-ban sebelumnya ---
        if (Cache::has("banned:{$ip}")) {
            Log::warning("🔥 BLOCKED permanently banned IP: {$ip}");
            abort(500, 'Server Error');
        }

        // --- Deteksi User Agent mencurigakan ---
        $botPatterns = '/bot|crawler|spider|curl|python|wget|scraper|go-http-client|axios|postman|insomnia|httpclient|http\s*library/i';
        $isSuspectUA = preg_match($botPatterns, $ua);

        // --- Rate limit sangat ketat untuk UA mencurigakan ---
        $maxAttempts = $isSuspectUA ? 5 : 100;     // 5 request/menit utk bot
        $decay       = $isSuspectUA ? 60 : 60;     // reset per 1 menit

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            Log::error("🚫 Too many attempts from {$ip} UA={$ua}");

            // Ban IP selama 1 jam jika terlalu sering
            Cache::put("banned:{$ip}", true, $this->banTime);

            abort(500, 'Server Error');
        }

        $this->limiter->hit($key, $decay);

        // --- Jika pattern bot jelas sekali, langsung potong ---
        if ($isSuspectUA && $this->limiter->attempts($key) > 3) {
            Log::warning("⚠️  Suspicious UA blocked early: {$ip} ({$ua})");
            abort(500, 'Server Error');
        }

        return $next($request);
    }
}
