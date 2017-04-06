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
                    'method' => request()->method(),
                    'root' => request()->root(),
                    'path' => request()->path(),
                    'query' => request()->query(),
                    'headers' => request()->server->getHeaders(),
                    'content' => request()->getContent(),
                    'request' => request()->all(),
                ],
            ]]);
        } catch (Exception $e) {
            echo nl2br(str_replace(' ', '&nbsp;', e((string) $e)));
            die;
        }
    }
}
