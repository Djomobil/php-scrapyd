<?php

namespace Djomobil\PhpScrapyd\Services;

use Djomobil\PhpScrapyd\Interfaces\DaemonServiceInterface;
use Djomobil\PhpScrapyd\Interfaces\JobServiceInterface;
use Djomobil\PhpScrapyd\Interfaces\ProjectServiceInterface;

class ScrapydService
{
    private DaemonServiceInterface $daemon;
    private JobServiceInterface $job;
    private ProjectServiceInterface $project;

    public function __construct(
        DaemonServiceInterface $daemonService,
        JobServiceInterface $jobService,
        ProjectServiceInterface $projectService,
        string $baseUrl,
        ?string $username = null,
        ?string $password = null,
        array $headers = []
    ) {
        $this->daemon = $daemonService;
        $this->job = $jobService;
        $this->project = $projectService;
    }

    public function daemon(): DaemonServiceInterface
    {
        return $this->daemon;
    }

    public function job(): JobServiceInterface
    {
        return $this->job;
    }

    public function project(): ProjectServiceInterface
    {
        return $this->project;
    }
}
