<?php

namespace Djomobil\PhpScrapyd\Tests\Unit;

use Djomobil\PhpScrapyd\Services\ProjectService;
use Djomobil\PhpScrapyd\Helpers\HttpHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class ProjectServiceTest extends TestCase
{
    private MockObject|HttpHelper $httpHelperMock;
    private ProjectService $projectService;

    protected function setUp(): void
    {
        $this->httpHelperMock = $this->getMockBuilder(HttpHelper::class)
                                      ->disableOriginalConstructor()
                                      ->getMock();

        $this->projectService = new ProjectService($this->httpHelperMock, 'http://localhost:6800');
    }

    public function testListProjects()
    {
        $this->httpHelperMock
            ->method('get')
            ->willReturn(['projects' => ['my_project']]);

        $projects = $this->projectService->listProjects();

        $this->assertIsArray($projects);
        $this->assertContains('my_project', $projects);
    }

    public function testListSpiders()
    {
        $this->httpHelperMock
            ->method('get')
            ->willReturn(['spiders' => ['my_spider']]);

        $spiders = $this->projectService->listSpiders('my_project');

        $this->assertIsArray($spiders);
        $this->assertContains('my_spider', $spiders);
    }

    public function testAddVersion()
    {
        $this->httpHelperMock
            ->method('post')
            ->willReturn(['status' => 'ok']);

        $result = $this->projectService->addVersion('my_project', '1.0', ['egg_data']);

        $this->assertIsArray($result);
        $this->assertEquals('ok', $result['status']);
    }

    public function testDeleteVersion()
    {
        $this->httpHelperMock
            ->method('post')
            ->willReturn(['status' => 'ok']);

        $result = $this->projectService->deleteVersion('my_project', '1.0');

        $this->assertIsArray($result);
        $this->assertEquals('ok', $result['status']);
    }

    public function testDeleteProject()
    {
        $this->httpHelperMock
            ->method('post')
            ->willReturn(['status' => 'ok']);

        $result = $this->projectService->deleteProject('my_project');

        $this->assertIsArray($result);
        $this->assertEquals('ok', $result['status']);
    }
}
