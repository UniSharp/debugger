<?php

namespace Tests\Fixtures;

class Request
{
    public function method()
    {
        return 'GET';
    }

    public function root()
    {
        return 'http://localhost';
    }

    public function path()
    {
        return '';
    }

    public function query()
    {
        return 'foo=bar';
    }

    public function headers()
    {
        return [];
    }

    public function getContent()
    {
        return [];
    }

    public function all()
    {
        return ['foo' => 'bar'];
    }
}
