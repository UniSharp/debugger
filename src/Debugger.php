<?php

namespace UniSharp\Debugger;

use Illuminate\Support\Facades\Log;

class Debugger
{
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

    protected function getDebug($label, $message)
    {
        return json_encode([
            'label' => $label,
            'message' => (string) $message,
            'request' => [
                'method' => app('request')->method(),
                'root' => app('request')->root(),
                'path' => app('request')->path(),
                'query' => app('request')->query(),
                'headers' => app('request')->headers(),
                'content' => app('request')->getContent(),
                'request' => app('request')->all()
            ]
        ]);
    }

    protected function request($level, $label, $message)
    {
        Log::$level($this->getDebug($label, $message));

        return $this;
    }
}
