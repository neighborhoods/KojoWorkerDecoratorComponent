<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator;

use Neighborhoods\ExceptionComponent\TransientException;
use Neighborhoods\Kojo\Api\V1\Worker\Service\AwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

class ExceptionHandling implements DecoratorInterface
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
            $this->getApiV1WorkerService()->requestRetry((new \DateTime())->add($this->getInterval()))->applyRequest();
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

    public function setRetryIntervalDefinition(string $intervalDefinition): self
    {
        if (isset($this->interval)) {
            throw new \LogicException('Interval is already set');
        }
        try {
            $this->interval = new \DateInterval($intervalDefinition);
        } catch (\Throwable $exception) {
            throw new \InvalidArgumentException('Invalid interval definition provided', 0, $exception);
        }

        return $this;
    }

    public function unsetInterval(): self
    {
        if (!isset($this->interval)) {
            throw new \LogicException('Interval is not set');
        }
        $this->interval = null;

        return $this;
    }

    public function getInterval(): \DateInterval
    {
        if (!isset($this->interval)) {
            throw new \LogicException('Interval is not set');
        }

        return $this->interval;
    }
}
