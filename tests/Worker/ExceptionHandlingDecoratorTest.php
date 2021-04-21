<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use LogicException;
use Neighborhoods\ExceptionComponent\TransientException;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;
use PHPUnit\Framework\TestCase;

use function json_encode;

class ExceptionHandlingDecoratorTest extends TestCase
{
    public function testWorkHoldsAndLogsJobThrowingNonTransientException(): void
    {
        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::once())->method('work')->willThrowException(
            new LogicException('oops I did a bad thing')
        );

        $logger = $this->createMock(V1\LoggerInterface::class);
        $logger->expects(self::once())->method('log')->with('critical', 'oops I did a bad thing');

        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->expects(self::once())->method('requestHold')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();
        $workerService->method('getLogger')->willReturn($logger);

        $decorator = new ExceptionHandlingDecorator();
        $decorator->setWorker($worker);
        $decorator->setApiV1WorkerService($workerService);
        $decorator->work();
    }

    public function testWorkRetriesAndLogsJobThrowingTransientException(): void
    {
        $worker = $this->createMock(WorkerInterface::class);
        $worker->expects(self::once())->method('work')->willThrowException(
            (new TransientException())->addMessage('I didn\'t do that bad')
        );

        $logger = $this->createMock(V1\LoggerInterface::class);
        $logger->expects(self::once())->method('log')->with('warning', '["I didn\'t do that bad"]');

        $workerService = $this->createMock(V1\Worker\ServiceInterface::class);
        $workerService->expects(self::once())->method('requestRetry')->willReturnSelf();
        $workerService->expects(self::once())->method('applyRequest')->willReturnSelf();
        $workerService->method('getLogger')->willReturn($logger);

        $decorator = new ExceptionHandlingDecorator();
        $decorator->setWorker($worker);
        $decorator->setApiV1WorkerService($workerService);
        $decorator->setRetryIntervalDefinition('PT1M');
        $decorator->work();
    }
}
