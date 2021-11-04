<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\WorkerDecorationV1Decorators;

use Exception;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;
use PHPUnit\Framework\TestCase;

class RetryThresholdV1DecoratorTest extends TestCase
{
    public function testWorkWithinThresholdRunsWorkerWithout(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->method('getTimesRetried')->willReturn(9);

        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::once())->method('work')->willReturnSelf();

        $decorator = new RetryThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorkerDecorationV1Worker($worker);
        $decorator->setThreshold(10);

        $result = $decorator->work();
        self::assertSame($decorator, $result);
    }

    public function testWorkWhenRetryThresholdExceededHolds(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->expects(self::once())->method('requestHold')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();
        $workerService->method('getTimesRetried')->willReturn(10);

        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::never())->method('work');

        $decorator = new RetryThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorkerDecorationV1Worker($worker);
        $decorator->setThreshold(10);

        $result = $decorator->work();
        self::assertSame($decorator, $result);
    }

    public function testSetZeroThresholdThrowsException(): void
    {
        $this->expectException(Exception::class);
        (new RetryThresholdDecorator())
            ->setThreshold(0);
    }
}
