<?php

namespace UniSharp\Debugger;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class DebuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('unisharp.debugger', function () {
            return new Debugger(new Client([
                'base_uri' => env('DEBUG_API_URI')
            ]));
        });
    }
}
