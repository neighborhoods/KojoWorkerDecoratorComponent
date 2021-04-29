<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\WorkerDecorationV1Decorators;

use DateTime;
use Exception;
use Neighborhoods\Kojo\Api\V1;
// @codingStandardsIgnoreLine Line below exceeds 120 characters
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;
use PHPUnit\Framework\TestCase;

class CrashedThresholdV1DecoratorTest extends TestCase
{
    public function testWorkFirstTimeRunsWorkerWithoutDelay(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->method('getTimesCrashed')->willReturn(0);

        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::once())->method('work')->willReturnSelf();

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorkerDecorationV1Worker($worker);
        $decorator->setThreshold(10);
        $decorator->setDelaySeconds(2);

        $start = new DateTime();
        $result = $decorator->work();
        $durationSeconds = ((new DateTime())->getTimestamp() - $start->getTimestamp());
        self::assertSame($decorator, $result);
        self::assertLessThanOrEqual(1, $durationSeconds);
    }

    public function testWorkAfterCrashRunsWorkerWithDelay(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->method('getTimesCrashed')->willReturn(1);

        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::once())->method('work')->willReturnSelf();

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorkerDecorationV1Worker($worker);
        $decorator->setThreshold(10);
        $decorator->setDelaySeconds(2);

        $start = new DateTime();
        $result = $decorator->work();
        $durationSeconds = ((new DateTime())->getTimestamp() - $start->getTimestamp());
        self::assertSame($decorator, $result);
        self::assertGreaterThanOrEqual(2, $durationSeconds);
    }

    public function testWorkWhenCrashThresholdExceededHoldsWithoutDelay(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->method('getTimesCrashed')->willReturn(10);
        $workerService->expects(self::once())->method('requestHold')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();

        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::never())->method('work');

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorkerDecorationV1Worker($worker);
        $decorator->setThreshold(10);
        $decorator->setDelaySeconds(2);

        $start = new DateTime();
        $result = $decorator->work();
        $durationSeconds = ((new DateTime())->getTimestamp() - $start->getTimestamp());
        self::assertSame($decorator, $result);
        self::assertLessThanOrEqual(1, $durationSeconds);
    }

    public function testSetZeroThresholdThrowsException(): void
    {
        $this->expectException(Exception::class);
        (new CrashedThresholdDecorator())
            ->setThreshold(0);
    }

    public function testSetZeroDelayThrowsException(): void
    {
        $this->expectException(Exception::class);
        (new CrashedThresholdDecorator())
            ->setDelaySeconds(0);
    }
}
