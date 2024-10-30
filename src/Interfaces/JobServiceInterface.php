<?php

namespace Djomobil\PhpScrapyd\Interfaces;

interface JobServiceInterface
{
    public function scheduleJob(array $args): string;
    public function cancelJob(string $project, string $jobId): array;
    public function listJobs(string $project): array;
}
