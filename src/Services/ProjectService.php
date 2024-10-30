<?php

namespace Djomobil\PhpScrapyd\Services;

use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use Djomobil\PhpScrapyd\Interfaces\ProjectServiceInterface;

class ProjectService implements ProjectServiceInterface
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

    public function listProjects(): array
    {
        $endpoint = $this->baseUrl . '/listprojects.json';
        $response = $this->httpHelper->get($endpoint, $this->username, $this->password, $this->headers);

        return $response['projects'] ?? [];
    }

    public function listSpiders(string $project): array
    {
        $endpoint = $this->baseUrl . '/listspiders.json';
        $args = ['project' => $project];
        $response = $this->httpHelper->get(
            $endpoint . '?' . http_build_query($args),
            $this->username,
            $this->password,
            $this->headers
        );

        return $response['spiders'] ?? [];
    }

    public function addVersion(string $project, string $version, array $eggs): array
    {
        $endpoint = $this->baseUrl . '/addversion.json';
        $args = [
            'project' => $project,
            'version' => $version,
            'eggs' => $eggs
        ];
        return $this->httpHelper->post($endpoint, $args, $this->username, $this->password, $this->headers);
    }

    public function deleteVersion(string $project, string $version): array
    {
        $endpoint = $this->baseUrl . '/delversion.json';
        $args = ['project' => $project, 'version' => $version];
        return $this->httpHelper->post($endpoint, $args, $this->username, $this->password, $this->headers);
    }

    public function deleteProject(string $project): array
    {
        $endpoint = $this->baseUrl . '/delproject.json';
        $args = ['project' => $project];
        return $this->httpHelper->post($endpoint, $args, $this->username, $this->password, $this->headers);
    }
}
