<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\WorkerDecorator;

use Neighborhoods\ExceptionComponent\TransientException;
use Neighborhoods\Kojo\Api\V1\LoggerInterface;
use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator\ExceptionHandling;

class ExceptionHandlingTest extends \PHPUnit\Framework\TestCase
{
    public function testWrappedNonTransient(): void
    {
        $worker = new class() {
            public function doSomethingBad(): void
            {
                throw new \LogicException('oops I did a bad thing');
            }
        };

        $decorator = new ExceptionHandling();
        $decorator->setWorker($worker);
        $decorator->setWorkerMethod('doSomethingBad');

        $workerService = $this->createMock(ServiceInterface::class);
        $decorator->setApiV1WorkerService($workerService);
        $workerService->expects($this->once())->method('requestHold')->willReturnSelf();
        $workerService->expects($this->once())->method('applyRequest')->willReturnSelf();

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('alert')->with('oops I did a bad thing');

        $workerService->method('getLogger')->willReturn($logger);

        $decorator->work();
    }

    public function testWrappedTransient(): void
    {
        $worker = new class() {
            public function doSomethingBad(): void
            {
                throw (new class () extends TransientException {
                })->addMessage('I didn\'t do that bad');
            }
        };

        $decorator = new ExceptionHandling();
        $decorator->setWorker($worker);
        $decorator->setWorkerMethod('doSomethingBad');

        $workerService = $this->createMock(ServiceInterface::class);
        $decorator->setApiV1WorkerService($workerService);
        $workerService->expects($this->once())->method('requestRetry')->willReturnSelf();
        $workerService->expects($this->once())->method('applyRequest')->willReturnSelf();

        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->once())->method('alert')->with(\json_encode(['I didn\'t do that bad']));

        $workerService->method('getLogger')->willReturn($logger);

        $decorator->work();
    }
}
