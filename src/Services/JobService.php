<?php

namespace Djomobil\PhpScrapyd\Services;

use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use Djomobil\PhpScrapyd\Interfaces\JobServiceInterface;

class JobService implements JobServiceInterface
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

    public function scheduleJob(array $args): string
    {
        $endpoint = $this->baseUrl . '/schedule.json';
        $response = $this->httpHelper->post($endpoint, $args, $this->username, $this->password, $this->headers);

        return $response['jobid'] ?? throw new \Exception('Failed to schedule job.');
    }

    public function cancelJob(string $project, string $jobId): array
    {
        $endpoint = $this->baseUrl . '/cancel.json';
        $args = ['project' => $project, 'job' => $jobId];
        return $this->httpHelper->post($endpoint, $args, $this->username, $this->password, $this->headers);
    }

    public function listJobs(string $project): array
    {
        $endpoint = $this->baseUrl . '/listjobs.json';
        $args = ['project' => $project];
        return $this->httpHelper->get(
            $endpoint . '?' . http_build_query($args),
            $this->username,
            $this->password,
            $this->headers
        );
    }
}
