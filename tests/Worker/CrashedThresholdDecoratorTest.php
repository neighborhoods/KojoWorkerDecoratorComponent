<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class CrashedThresholdDecoratorTest extends \PHPUnit\Framework\TestCase
{
    public function testExceedsCrashes(): void
    {
        $workerService = $this->createMock(ServiceInterface::class);
        $workerService->expects($this->once())->method('requestHold')->willReturnSelf();
        $workerService->expects($this->once())->method('applyRequest')->willReturnSelf();
        $workerService->method('getTimesCrashed')->willReturn(10);

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorker(
            new class implements WorkerInterface {
                public function work(): WorkerInterface
                {
                    // do something
                    throw new \LogicException('Should have not get here.');
                }
            }
        );
        $decorator->setThreshold(10);

        $decorator->work();
    }

    public function testZeroLimit(): void
    {
        $workerService = $this->createMock(ServiceInterface::class);
        $workerService->expects($this->never())->method('requestHold');
        $workerService->expects($this->never())->method('applyRequest');
        $workerService->method('getTimesCrashed')->willReturn(10);

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService)
            ->setWorker(
                new class implements WorkerInterface{
                    public function work(): WorkerInterface
                    {
                        return $this;
                    }
                }
            )
            ->setThreshold(0);

        $decorator->work();
    }
}
