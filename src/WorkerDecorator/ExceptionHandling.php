<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator;

use Neighborhoods\ExceptionComponent\TransientException;
use Neighborhoods\Kojo\Api\V1\Worker\Service\AwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

class ExceptionHandling implements \Neighborhoods\KojoWorkerDecoratorComponent\DecoratorInterface
{
    use WorkerAwareTrait;
    use AwareTrait;

    public function work(): void
    {
        try {
            \call_user_func([$this->getWorker(), $this->getWorkerMethod()]);
        } catch (TransientException $transientException) {
            $this->getApiV1WorkerService()->requestRetry(new \DateTime())->applyRequest();
            $this->logThrowable($transientException);
        } catch (\Throwable $throwable) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->logThrowable($throwable);
        }
    }

    private function logThrowable(\Throwable $throwable): void
    {
        $context = [
            'job_id' => $this->getApiV1WorkerService()->getJobId(),
            'worker' => $this->getWorker(),
            'message' => $throwable->getMessage(),
            'exception' => $throwable,
        ];
        $this->getApiV1WorkerService()->getLogger()->alert($throwable->getMessage(), $context);
    }
}
