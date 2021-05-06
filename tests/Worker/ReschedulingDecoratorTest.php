<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use DateTime;
use PDO;
use Exception;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use Neighborhoods\ThrowableDiagnosticComponent\ThrowableDiagnosticV1\ThrowableDiagnostic;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ReschedulingDecoratorTest extends TestCase
{
    private $decorator;
    /**
     * @var PDO&MockObject
     */
    private $pdoMock;
    /**
     * @var V1\Worker\ServiceInterface&MockObject
     */
    private $kojoWorkerServiceMock;
    /**
     * @var ThrowableDiagnostic\Builder\FactoryInterface&MockObject
     */
    private $throwableDiagnosticBuilderFactoryMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->decorator = new ReschedulingDecorator();
        $this->throwableDiagnosticBuilderFactoryMock =
            $this->createMock(ThrowableDiagnostic\Builder\FactoryInterface::class);
        $this->kojoWorkerServiceMock = $this->createMock(V1\Worker\ServiceInterface::class);
        $this->pdoMock = $this->createMock(PDO::class);

        $this->decorator->setJobTypeCode('jobTypeCode');
        $this->decorator->setRescheduleDelaySeconds(1);
        $this->decorator->setThrowableDiagnosticV1ThrowableDiagnosticBuilderFactory(
            $this->throwableDiagnosticBuilderFactoryMock
        );
        $this->decorator->setApiV1WorkerService($this->kojoWorkerServiceMock);
        $this->decorator->setPdo($this->pdoMock);
    }

    public function tearDown(): void
    {
        unset(
            $this->pdoMock,
            $this->decorator,
            $this->kojoWorkerServiceMock,
            $this->throwableDiagnosticBuilderFactoryMock
        );
        parent::tearDown();
    }

    public function testWorkShouldRunAnIncompleteWorkerAndCompleteAndRescheduleItWithDelay(): void
    {
        $workerMock = $this->createMock(WorkerInterface::class);
        $workerMock->expects(self::once())
            ->method('work')
            ->willReturnSelf();
        $this->decorator->setWorker($workerMock);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('isRequestApplied')
            ->willReturn(false);

        $this->pdoMock->expects(self::once())
            ->method('beginTransaction');

        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('requestCompleteSuccess')
            ->willReturnSelf();
        $this->kojoWorkerServiceMock->expects(self::once())
            ->method('applyRequest')
            ->willReturnSelf();

        $schedulerMock = $this->createMock(V1\Job\SchedulerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getNewJobScheduler')
            ->willReturn($schedulerMock);
        $schedulerMock->expects(self::once())
            ->method('setWorkAtDateTime')
            ->with(self::greaterThanOrEqual(new DateTime('+1 second')))
            ->willReturnSelf();
        $schedulerMock->expects(self::once())
            ->method('setJobTypeCode')
            ->with('jobTypeCode')
            ->willReturnSelf();
        $schedulerMock->expects(self::once())
            ->method('save')
            ->willReturnSelf();
        $this->pdoMock->expects(self::once())
            ->method('commit');
        $this->pdoMock->expects(self::never())
            ->method('rollBack');
        $this->throwableDiagnosticBuilderFactoryMock
            ->expects(self::never())
            ->method('create');

        $this->decorator->work();
    }

    public function testWorkShouldNotHandleWorkerException(): void
    {
        $throwable = new Exception();
        $workerMock = $this->createMock(WorkerInterface::class);
        $workerMock->expects(self::once())
            ->method('work')
            ->willThrowException($throwable);
        $this->decorator->setWorker($workerMock);

        $this->expectExceptionObject($throwable);
        $this->throwableDiagnosticBuilderFactoryMock
            ->expects(self::never())
            ->method('create');
        $this->decorator->work();
    }

    public function testWorkShouldNotRescheduleWorkerWithAppliedStatus(): void
    {
        $workerMock = $this->createMock(WorkerInterface::class);
        $workerMock->expects(self::once())
            ->method('work')
            ->willReturnSelf();
        $this->decorator->setWorker($workerMock);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('isRequestApplied')
            ->willReturn(true);

        $this->pdoMock->expects(self::never())
            ->method('beginTransaction');
        $this->kojoWorkerServiceMock->expects(self::never())
            ->method('applyRequest');
        $this->kojoWorkerServiceMock
            ->expects(self::never())
            ->method('getNewJobScheduler');
        $this->pdoMock->expects(self::never())
            ->method('commit');
        $this->pdoMock->expects(self::never())
            ->method('rollBack');
        $this->throwableDiagnosticBuilderFactoryMock
            ->expects(self::never())
            ->method('create');

        // Assert that warning is logged
        $loggerMock = $this->createMock(V1\LoggerInterface::class);
        $this->kojoWorkerServiceMock
            ->expects(self::once())
            ->method('getLogger')
            ->willReturn($loggerMock);
        $loggerMock
            ->expects(self::once())
            ->method('warning')
            ->with('Kojo worker state request already applied, not rescheduling.');

        $this->decorator->work();
    }
}
