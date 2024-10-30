<?php

namespace Djomobil\PhpScrapyd\Services;

use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use Djomobil\PhpScrapyd\Interfaces\DaemonServiceInterface;

class DaemonService implements DaemonServiceInterface
{
    private string $baseUrl;
    private ?string $username;
    private ?string $password;
    private array $headers;
    private HttpHelper $httpHelper;

    public function __construct(
        HttpHelper $httpHelper, // Paramètre obligatoire placé avant les paramètres optionnels
        string $baseUrl,
        ?string $username = null,
        ?string $password = null,
        array $headers = []
    ) {
        $this->httpHelper = $httpHelper;
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->headers = $headers;
    }

    public function getDaemonStatus(): array
    {
        $endpoint = $this->baseUrl . '/daemonstatus.json';
        return $this->httpHelper->get($endpoint, $this->username, $this->password, $this->headers);
    }
}
