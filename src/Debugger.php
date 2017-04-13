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

    public function error($label, $message)
    {
        return $this->request('post', 'error', $label, $message);
    }

    protected function request($method, $path, $label, $message)
    {
        try {
            return $this->client->request($method, $path, ['json' => [
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
