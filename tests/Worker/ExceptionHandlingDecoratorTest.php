<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use LogicException;
use Neighborhoods\ExceptionComponent\TransientException;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use PHPUnit\Framework\TestCase;

use function json_encode;

class ExceptionHandlingDecoratorTest extends TestCase
{
    public function testWrappedNonTransient(): void
    {
        $worker = new class () implements WorkerInterface {
            use V1\Worker\Service\AwareTrait;
            use V1\RDBMS\Connection\Service\AwareTrait;

            public function work(): WorkerInterface
            {
                throw new LogicException('oops I did a bad thing');
            }
        };

        $decorator = new ExceptionHandlingDecorator();
        $decorator->setWorker($worker);

        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $decorator->setApiV1WorkerService($workerService);
        $workerService->expects(self::once())->method('requestHold')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();

        $logger = $this->createMock(V1\LoggerInterface::class);
        $logger->expects(self::once())->method('alert')->with('oops I did a bad thing');

        $workerService->method('getLogger')->willReturn($logger);

        $decorator->work();
    }

    public function testWrappedTransient(): void
    {
        $worker = new class () implements WorkerInterface {
            use V1\Worker\Service\AwareTrait;
            use V1\RDBMS\Connection\Service\AwareTrait;

            public function work(): WorkerInterface
            {
                throw (new class () extends TransientException {
                })->addMessage('I didn\'t do that bad');
            }
        };

        $decorator = new ExceptionHandlingDecorator();
        $decorator->setWorker($worker);

        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setRetryIntervalDefinition('PT1M');
        $workerService->expects(self::once())->method('requestRetry')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();

        $logger = $this->createMock(V1\LoggerInterface::class);
        $logger->expects(self::once())->method('alert')->with(json_encode(['I didn\'t do that bad']));

        $workerService->method('getLogger')->willReturn($logger);

        $decorator->work();
    }
}
