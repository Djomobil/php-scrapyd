<?php

namespace Djomobil\PhpScrapyd\Tests\Unit;

use Djomobil\PhpScrapyd\Services\JobService;
use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class JobServiceTest extends TestCase
{
    private MockObject|HttpHelper $httpHelperMock;
    private JobService $jobService;

    protected function setUp(): void
    {
        $this->httpHelperMock = $this->createMock(HttpHelper::class);
        $this->jobService = new JobService($this->httpHelperMock, 'http://localhost:6800');
    }

    public function testScheduleJob()
    {
        $this->httpHelperMock
            ->method('post')
            ->willReturn(['jobid' => 'test_job_id']);

        $jobId = $this->jobService->scheduleJob(['project' => 'my_project', 'spider' => 'my_spider']);

        $this->assertEquals('test_job_id', $jobId);
    }

    public function testListJobs()
    {
        $this->httpHelperMock
            ->method('get')
            ->willReturn([
                'pending' => [],
                'running' => [],
                'finished' => []
            ]);

        $jobs = $this->jobService->listJobs('my_project');

        $this->assertIsArray($jobs);
        $this->assertArrayHasKey('pending', $jobs);
        $this->assertArrayHasKey('running', $jobs);
        $this->assertArrayHasKey('finished', $jobs);
    }

    public function testCancelJob()
    {
        $this->httpHelperMock
            ->method('post')
            ->willReturn([
                'prevstate' => 'running',
                'newstate' => 'cancelled'
            ]);

        $result = $this->jobService->cancelJob('my_project', 'test_job_id');

        $this->assertIsArray($result);
        $this->assertEquals('running', $result['prevstate']);
        $this->assertEquals('cancelled', $result['newstate']);
    }
}
