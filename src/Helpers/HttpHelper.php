<?php

namespace Djomobil\PhpScrapyd\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HttpHelper
{
    private Client $client;

    public function __construct(array $headers = [])
    {
        $this->client = new Client(['headers' => $headers, 'verify' => false]);
    }

    public function post(string $url, array $data = [], ?string $username = null, ?string $password = null): array
    {
        $options = ['form_params' => $data];

        if ($username && $password) {
            $options['auth'] = [$username, $password];
        }

        try {
            $response = $this->client->post($url, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('HTTP POST request failed: ' . $e->getMessage());
        }
    }

    public function get(string $url, ?string $username = null, ?string $password = null): array
    {
        $options = [];

        if ($username && $password) {
            $options['auth'] = [$username, $password];
        }

        try {
            $response = $this->client->get($url, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('HTTP GET request failed: ' . $e->getMessage());
        }
    }
}
