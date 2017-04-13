<?php

namespace UniSharp\Debugger;

use Exception;
use GuzzleHttp\ClientInterface;

class Debugger
{
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function debug($label, $message)
    {
        return $this->request('debug', $label, $message);
    }

    public function info($label, $message)
    {
        return $this->request('info', $label, $message);
    }

    public function notice($label, $message)
    {
        return $this->request('notice', $label, $message);
    }

    public function warning($label, $message)
    {
        return $this->request('warning', $label, $message);
    }

    public function error($label, $message)
    {
        return $this->request('error', $label, $message);
    }

    protected function request($method, $level, $label, $message)
    {
        try {
            return $this->client->post($level, ['json' => [
                'label' => $label,
                'message' => (string) $message,
                'request' => [
                    'method' => app('request')->method(),
                    'root' => app('request')->root(),
                    'path' => app('request')->path(),
                    'query' => app('request')->query(),
                    'headers' => app('request')->headers(),
                    'content' => app('request')->getContent(),
                    'request' => app('request')->all(),
                ],
            ]]);
        } catch (Exception $e) {
            echo nl2br(str_replace(' ', '&nbsp;', e((string) $e)));
            die;
        }
    }
}
