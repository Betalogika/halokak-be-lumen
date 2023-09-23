<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PlatformVersion;
use Illuminate\Support\Facades\Auth;

class UsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action user
        if (Auth::guard('user')->user()->role_id != 5) {
            return response()->json('anda bukan user', 401);
        }

        if (!$request->header('X-HALOKAK-PLATFORM') || !$request->header('X-HALOKAK-VERSION')) {
            return response()->json('masukan platform and version', 401);
        }

        if (!PlatformVersion::whereplatform($request->header('X-HALOKAK-PLATFORM'))->first()) {
            return response()->json('platform salah', 401);
        }
        if (!PlatformVersion::whereversion($request->header('X-HALOKAK-VERSION'))->first()) {
            return response()->json('version salah', 401);
        }

        return $next($request);
    }
}
