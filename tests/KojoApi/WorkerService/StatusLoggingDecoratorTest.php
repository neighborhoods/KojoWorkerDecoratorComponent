<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\KojoApi\WorkerService;

use DateTime;
use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Api\V1\LoggerInterface;
use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
use Neighborhoods\Kojo\Apm\NewRelicInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\StatusLoggingDecorator;
use PHPUnit\Framework\TestCase;

class StatusLoggingDecoratorTest extends TestCase
{
    private $decorator;

    private $kojoWorkerServiceMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->decorator = new StatusLoggingDecorator();

        $this->kojoWorkerServiceMock = $this->createMock(ServiceInterface::class);

        $this->decorator->setApiV1WorkerService($this->kojoWorkerServiceMock);
        $this->kojoWorkerServiceMock
            ->method('getJobId')
            ->willReturn(1000);
    }

    public function tearDown(): void
    {
        unset($this->decorator);
        parent::tearDown();
    }

    public function testRequestRetryShouldLogRetryAndRequestRetry(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($logger);
        $logger->expects(self::once())
            ->method('notice')
            ->with('task_status', [
                'status' => 'retry',
                'job_id' => 1000,
            ]);
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('requestRetry')
            ->willReturnSelf();
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('applyRequest')
            ->willReturnSelf();
        $result = $this->decorator->requestRetry(new DateTime())->applyRequest();
        self::assertSame($this->decorator, $result);
    }

    public function testRequestHoldShouldLogHoldAndRequestHold(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($logger);
        $logger->expects(self::once())
            ->method('notice')
            ->with('task_status', [
                'status' => 'hold',
                'job_id' => 1000,
            ]);

        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('requestHold')
            ->willReturnSelf();
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('applyRequest')
            ->willReturnSelf();
        $result = $this->decorator->requestHold()->applyRequest();
        self::assertSame($this->decorator, $result);
    }

    public function testRequestCompleteSuccessShouldLogCompleteSuccessAndRequestCompleteSuccess(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($logger);
        $logger->expects(self::once())
            ->method('notice')
            ->with('task_status', [
                'status' => 'complete_success',
                'job_id' => 1000,
            ]);

        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('requestCompleteSuccess')
            ->willReturnSelf();
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('applyRequest')
            ->willReturnSelf();
        $result = $this->decorator->requestCompleteSuccess()->applyRequest();
        self::assertSame($this->decorator, $result);
    }

    public function testRequestCompleteFailedShouldLogCompleteFailedAndRequestCompleteFailed(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($logger);
        $logger->expects(self::once())
            ->method('notice')
            ->with('task_status', [
                'status' => 'complete_failed',
                'job_id' => 1000,
            ]);

        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('requestCompleteFailed')
            ->willReturnSelf();
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('applyRequest')
            ->willReturnSelf();
        $result = $this->decorator->requestCompleteFailed()->applyRequest();
        self::assertSame($this->decorator, $result);
    }

    /**
     * @dataProvider getBooleans
     */
    public function testIsRequestAppliedShouldMimicDecoratedBehaviour(bool $isApplied): void
    {
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('isRequestApplied')
            ->willReturn($isApplied);
        $result = $this->decorator->isRequestApplied();
        self::assertEquals($isApplied, $result);
    }

    public function testGetLoggerShouldMimicDecoratedBehaviour(): void
    {
        $loggerMock = $this->createMock(LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($loggerMock);
        $result = $this->decorator->getLogger();
        self::assertSame($loggerMock, $result);
    }

    public function testGetNewJobSchedulerShouldMimicDecoratedBehaviour(): void
    {
        $schedulerMock = $this->createMock(SchedulerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getNewJobScheduler')
            ->willReturn($schedulerMock);
        $result = $this->decorator->getNewJobScheduler();
        self::assertSame($schedulerMock, $result);
    }

    public function testReloadShouldMimicDecoratedBehaviour(): void
    {
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('reload')
            ->willReturnSelf();
        $result = $this->decorator->reload();
        self::assertSame($this->decorator, $result);
    }

    public function testGetTimesCrashedShouldMimicDecoratedBehaviour(): void
    {
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('getTimesCrashed')
            ->willReturn(10);
        $result = $this->decorator->getTimesCrashed();
        self::assertEquals(10, $result);
    }

    public function testGetTimesRetriedShouldMimicDecoratedBehaviour(): void
    {
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('getTimesRetried')
            ->willReturn(10);
        $result = $this->decorator->getTimesRetried();
        self::assertEquals(10, $result);
    }

    public function testGetJobIdShouldMimicDecoratedBehaviour(): void
    {
        $result = $this->decorator->getJobId();
        self::assertSame(1000, $result);
    }

    public function testGetNewRelicShouldMimicDecoratedBehaviour(): void
    {
        $newRelicMock = $this->createMock(NewRelicInterface::class);
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('getNewRelic')
            ->willReturn($newRelicMock);
        $result = $this->decorator->getNewRelic();
        self::assertSame($newRelicMock, $result);
    }

    public function getBooleans(): array
    {
        return [
            [true],
            [false],
        ];
    }
}
