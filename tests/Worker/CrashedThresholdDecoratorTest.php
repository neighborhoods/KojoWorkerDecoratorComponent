<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use LogicException;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use PHPUnit\Framework\TestCase;

class CrashedThresholdDecoratorTest extends TestCase
{
    public function testExceedsCrashes(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->expects(self::once())->method('requestHold')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();
        $workerService->method('getTimesCrashed')->willReturn(10);

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setWorker(
            new class implements WorkerInterface {
                use V1\Worker\Service\AwareTrait;
                use V1\RDBMS\Connection\Service\AwareTrait;

                public function work(): WorkerInterface
                {
                    // do something
                    throw new LogicException('Should have not get here.');
                }
            }
        );
        $decorator->setThreshold(10);

        $decorator->work();
    }

    public function testZeroLimit(): void
    {
        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->expects(self::never())->method('requestHold');
        $workerService->expects(self::never())->method('applyRequest');
        $workerService->method('getTimesCrashed')->willReturn(10);

        $decorator = new CrashedThresholdDecorator();
        $decorator->setApiV1WorkerService($workerService)
            ->setWorker(
                new class implements WorkerInterface{
                    use V1\Worker\Service\AwareTrait;
                    use V1\RDBMS\Connection\Service\AwareTrait;

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
