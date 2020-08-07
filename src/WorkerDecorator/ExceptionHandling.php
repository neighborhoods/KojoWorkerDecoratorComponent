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

    /**
     * @var \DateInterval|null
     */
    private $interval;

    public function work(): void
    {
        try {
            \call_user_func([$this->getWorker(), $this->getWorkerMethod()]);
        } catch (TransientException $transientException) {
            $time = new \DateTime();
            if ($this->interval) {
                $time = $time->add($this->interval);
            }
            $this->getApiV1WorkerService()->requestRetry($time)->applyRequest();
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

    public function setRetryIntervalDefinition(string $intervalDefinition): void
    {
        try {
            $this->interval = new \DateInterval($intervalDefinition);
        } catch (\Throwable $exception) {
            throw new \InvalidArgumentException('Invalid interval definition provided', 0, $exception);
        }
    }
}
