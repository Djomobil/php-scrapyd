<?php

namespace Djomobil\PhpScrapyd\Interfaces;

interface ProjectServiceInterface
{
    public function listProjects(): array;
    public function listSpiders(string $project): array;
    public function addVersion(string $project, string $version, array $eggs): array;
    public function deleteVersion(string $project, string $version): array;
    public function deleteProject(string $project): array;
}
