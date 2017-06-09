<?php

namespace UniSharp\Debugger;

use Closure;
use GuzzleHttp\Pool;

class DebuggerMiddleware
{
    public function terminate($request, $response)
    {
        foreach (app('unisharp.debugger')->getRequests() as $request) {
            $request();
        }
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
