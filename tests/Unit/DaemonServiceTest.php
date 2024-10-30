<?php

namespace Djomobil\PhpScrapyd\Tests\Unit;

use Djomobil\PhpScrapyd\Services\DaemonService;
use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class DaemonServiceTest extends TestCase
{
    private MockObject|HttpHelper $httpHelperMock;
    private DaemonService $daemonService;

    protected function setUp(): void
    {
        $this->httpHelperMock = $this->createMock(HttpHelper::class);
        $this->daemonService = new DaemonService($this->httpHelperMock, 'http://localhost:6800');
    }

    public function testGetDaemonStatus()
    {
        $this->httpHelperMock
            ->method('get')
            ->willReturn([
                'status' => 'ok',
                'node_name' => 'scrapyd',
                'pending' => 0,
                'running' => 0,
                'finished' => 0
            ]);

        $status = $this->daemonService->getDaemonStatus();

        $this->assertIsArray($status);
        $this->assertEquals('ok', $status['status']);
    }
}
