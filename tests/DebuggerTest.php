<?php

namespace Tests;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use UniSharp\Debugger\Debugger;
use Illuminate\Support\Facades\Log;

class DebuggerTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testDebug()
    {
        Log::shouldReceive('debug')
            ->once()
            ->andReturn(true);

        $debugger = new Debugger();

        $this->assertInstanceOf(Debugger::class, $debugger->debug('foo', 'bar'));
    }

    public function testInfo()
    {
        Log::shouldReceive('info')
            ->once()
            ->andReturn(true);

        $debugger = new Debugger();

        $this->assertInstanceOf(Debugger::class, $debugger->info('foo', 'bar'));
    }

    public function testWarning()
    {
        Log::shouldReceive('warning')
            ->once()
            ->andReturn(true);

        $debugger = new Debugger();

        $this->assertInstanceOf(Debugger::class, $debugger->info('foo', 'bar'));
    }

    public function testError()
    {
        Log::shouldReceive('error')
            ->once()
            ->andReturn(true);

        $debugger = new Debugger();

        $this->assertInstanceOf(Debugger::class, $debugger->info('foo', 'bar'));
    }
}
