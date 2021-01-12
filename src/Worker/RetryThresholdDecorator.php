<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use UnexpectedValueException;

final class RetryThresholdDecorator implements RetryThresholdDecoratorInterface
{
    use DecoratorTrait;

    /**
     * @var int
     */
    private $threshold;

    public function work(): WorkerInterface
    {
        $threshold = $this->getThreshold();
        if ($this->getApiV1WorkerService()->getTimesCrashed() >= $threshold) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->getApiV1WorkerService()->getLogger()
                ->critical('Worker exceeded retry threshold', ['threshold' => $threshold]);
        } else {
            $this->runWorker();
        }
        return $this;
    }

    public function setThreshold(int $threshold): RetryThresholdDecoratorInterface
    {
        if (isset($this->threshold)) {
            throw new LogicException('Threshold is already set');
        }
        if ($threshold < 1) {
            throw new UnexpectedValueException('Threshold must be a positive integer, ' .
                'if you want to disable it remove the ' . static::class .
                ' from the worker builder service definition (YAML file).');
        }
        $this->threshold = $threshold;

        return $this;
    }

    private function getThreshold(): int
    {
        if (!isset($this->threshold)) {
            throw new LogicException('Threshold is not set');
        }

        return $this->threshold;
    }
}
