<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator;

use Neighborhoods\Kojo\Api\V1\Worker\Service\AwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

class CrashedThreshold implements DecoratorInterface
{
    use AwareTrait;
    use WorkerAwareTrait;

    /**
     * @var int
     */
    private $threshold;

    public function work(): void
    {
        $threshold = $this->getThreshold();
        if ($threshold > 0 && $this->getApiV1WorkerService()->getTimesCrashed() >= $threshold) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->getApiV1WorkerService()->getLogger()
                ->critical(\sprintf('Worker exceeded crash threshold %d', $threshold));
        } else {
            $this->runWorker();
        }
    }

    public function setThreshold(int $threshold): DecoratorInterface
    {
        if (isset($this->threshold)) {
            throw new \LogicException('Threshold is already set');
        }
        $this->threshold = $threshold;

        return $this;
    }

    public function unsetThreshold(): DecoratorInterface
    {
        if (!isset($this->threshold)) {
            throw new \LogicException('Threshold is not set');
        }
        $this->threshold = null;

        return $this;
    }

    public function getThreshold(): int
    {
        if (!isset($this->threshold)) {
            throw new \LogicException('Threshold is not set');
        }

        return $this->threshold;
    }
}
