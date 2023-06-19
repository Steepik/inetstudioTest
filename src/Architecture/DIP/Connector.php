<?php

namespace Steepik\Architecture\DIP;

interface Connector
{
    public function request(string $url, Method $method, array $options = []): void;
}