<?php

namespace UniSharp\Debugger;

use Closure;
use GuzzleHttp\Pool;

class DebuggerMiddleware
{
    public function terminate($request, $response)
    {
        array_walk(app('unisharp.debugger')->getRequests(), function ($callback) {
            $callback();
        });
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
