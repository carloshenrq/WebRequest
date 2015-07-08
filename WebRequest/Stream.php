<?php

namespace WebRequest;

/**
 * Classe para realizar as chamadas de requisição via STREAM.
 */
class Stream extends HttpRequest
{
    public function __construct()
    {
        $this->registerGlobal($this);
    }

    public function execute($url, $method = 'GET', $data = [], $header = [])
    {
        return "{}";
    }
}

