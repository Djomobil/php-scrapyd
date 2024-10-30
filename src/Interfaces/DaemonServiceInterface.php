<?php

namespace Djomobil\PhpScrapyd\Interfaces;

interface DaemonServiceInterface
{
    public function getDaemonStatus(): array;
}
