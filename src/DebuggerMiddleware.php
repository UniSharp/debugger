<?php

namespace UniSharp\Debugger;

use Closure;
use Exception;
use GuzzleHttp\Pool;

class DebuggerMiddleware
{
    public function terminate($request, $response)
    {
        foreach (app('unisharp.debugger')->getRequests() as $request) {
            try {
                $request();
            } catch (Exception $e) {
                //
            }
        }
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
