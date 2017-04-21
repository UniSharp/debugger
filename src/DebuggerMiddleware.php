<?php

namespace UniSharp\Debugger;

use Closure;
use GuzzleHttp\Pool;

class DebuggerMiddleware
{
    public function terminate($request, $response)
    {
        $debugger = app('unisharp.debugger');

        $pool = new Pool($debugger->getClient(), $debugger->getRequests(), [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) {
            },
            'rejected' => function ($reason, $index) {
                echo nl2br(str_replace(' ', '&nbsp;', e((string) $reason)));
                die;
            },
        ]);

        $promise = $pool->promise();

        $promise->wait();
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
