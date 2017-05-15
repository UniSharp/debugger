<?php

namespace Tests;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use UniSharp\Debugger\Debugger;
use GuzzleHttp\Promise\PromiseInterface;

class DebuggerTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testGetClient()
    {
        $debugger = new Debugger($client = m::mock(ClientInterface::class));

        $this->assertEquals($client, $debugger->getClient());
    }

    public function testGetRequests()
    {
        $debugger = new Debugger($client = m::mock(ClientInterface::class));

        $this->assertEquals([], $debugger->getRequests());
    }

    public function testDebug()
    {
        $debugger = new Debugger($this->getClient());

        $this->assertInstanceOf(Debugger::class, $debugger->debug('foo', 'bar'));
        $this->assertInstanceOf(PromiseInterface::class, $debugger->getRequests()[0]());
    }

    public function testInfo()
    {
        $debugger = new Debugger($this->getClient());

        $this->assertInstanceOf(Debugger::class, $debugger->info('foo', 'bar'));
        $this->assertInstanceOf(PromiseInterface::class, $debugger->getRequests()[0]());
    }

    public function testNotice()
    {
        $debugger = new Debugger($this->getClient());

        $this->assertInstanceOf(Debugger::class, $debugger->notice('foo', 'bar'));
        $this->assertInstanceOf(PromiseInterface::class, $debugger->getRequests()[0]());
    }

    public function testWarning()
    {
        $debugger = new Debugger($this->getClient());

        $this->assertInstanceOf(Debugger::class, $debugger->warning('foo', 'bar'));
        $this->assertInstanceOf(PromiseInterface::class, $debugger->getRequests()[0]());
    }

    public function testError()
    {
        $debugger = new Debugger($this->getClient());

        $this->assertInstanceOf(Debugger::class, $debugger->error('foo', 'bar'));
        $this->assertInstanceOf(PromiseInterface::class, $debugger->getRequests()[0]());
    }

    protected function getClient()
    {
        $client = m::mock(ClientInterface::class);

        $client->shouldReceive('postAsync')->andReturn(m::mock(PromiseInterface::class));

        return $client;
    }
}
