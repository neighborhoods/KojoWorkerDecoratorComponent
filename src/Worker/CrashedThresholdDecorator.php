<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use LogicException;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use UnexpectedValueException;

class CrashedThresholdDecorator implements CrashedThresholdDecoratorInterface
{
    use DecoratorTrait;
    use V1\Worker\Service\AwareTrait;

    /**
     * @var int
     */
    private $threshold;
    private $delaySeconds;

    public function work(): WorkerInterface
    {
        $threshold = $this->getThreshold();
        if ($this->getApiV1WorkerService()->getTimesCrashed() >= $threshold) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->getApiV1WorkerService()->getLogger()
                ->critical('Worker exceeded crash threshold', ['threshold' => $threshold]);
        } else {
            // Prevent worker to immediately retry
            if ($this->getApiV1WorkerService()->getTimesCrashed() > 0) {
                sleep($this->getDelaySeconds());
            }
            $this->runWorker();
        }
        return $this;
    }

    public function setThreshold(int $threshold): CrashedThresholdDecoratorInterface
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

    private function getDelaySeconds(): int
    {
        if (!isset($this->delaySeconds)) {
            throw new LogicException('Delay has not been set.');
        }
        return $this->delaySeconds;
    }

    public function setDelaySeconds(int $delaySeconds): CrashedThresholdDecoratorInterface
    {
        if (isset($this->delaySeconds)) {
            throw new LogicException('Delay is already set.');
        }
        if ($delaySeconds < 1) {
            throw new UnexpectedValueException('Delay must be a positive integer');
        }
        $this->delaySeconds = $delaySeconds;
        return $this;
    }
}
