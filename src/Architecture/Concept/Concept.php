<?php

namespace Steepik\Architecture\Concept;

final class Concept
{
    public function __construct(
        private readonly Storage $storage,
        private \GuzzleHttp\Client $client,
    ) {
    }

    public function getUserData(): void
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->storage->get(),
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }
}