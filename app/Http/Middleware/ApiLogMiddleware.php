<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Facades\ApiLog;

class ApiLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        ApiLog::info(json_encode([
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'headers' => $request->header(),
            'body' => $request->all(),
            'ip' => $request->ip(),
            'created_at' => time()
        ]), 'apilogs');

        return $next($request);
    }
}
