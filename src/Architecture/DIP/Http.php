<?php

namespace Steepik\Architecture\DIP;

final readonly class Http
{
    public function __construct(
        private Connector $connector
    ) {
    }

    public function get(string $url, array $options): void
    {
        $this->connector->request(url: $url, method: Method::GET, options: $options);
    }

    public function post(string $url): void
    {
        $this->connector->request(url: $url, method: Method::GET);
    }
}