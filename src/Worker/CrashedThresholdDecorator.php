<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class CrashedThresholdDecorator implements CrashedThresholdDecoratorInterface
{
    use DecoratorTrait;

    /**
     * @var int
     */
    private $threshold;

    public function work(): WorkerInterface
    {
        $threshold = $this->getThreshold();
        if ($threshold > 0 && $this->getApiV1WorkerService()->getTimesCrashed() >= $threshold) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->getApiV1WorkerService()->getLogger()
                ->critical(\sprintf('Worker exceeded crash threshold %d', $threshold));
        } else {
            $this->runWorker();
        }
        return $this;
    }

    public function setThreshold(int $threshold): CrashedThresholdDecoratorInterface
    {
        if (isset($this->threshold)) {
            throw new \LogicException('Threshold is already set');
        }
        $this->threshold = $threshold;

        return $this;
    }

    private function getThreshold(): int
    {
        if (!isset($this->threshold)) {
            throw new \LogicException('Threshold is not set');
        }

        return $this->threshold;
    }
}
