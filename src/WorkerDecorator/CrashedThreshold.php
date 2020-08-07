<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator;

use Neighborhoods\Kojo\Api\V1\Worker\Service\AwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

class CrashedThreshold implements \Neighborhoods\KojoWorkerDecoratorComponent\DecoratorInterface
{
    use AwareTrait;
    use WorkerAwareTrait;

    /**
     * @var int
     */
    private $threshold = 0;

    public function work(): void
    {
        if ($this->threshold > 0 && $this->getApiV1WorkerService()->getTimesCrashed() >= $this->threshold) {
            $this->getApiV1WorkerService()->requestHold()->applyRequest();
            $this->getApiV1WorkerService()->getLogger()
                ->critical(\sprintf('Worker exceeded crash threshold %d', $this->threshold));
            return;
        }
        \call_user_func([$this->getWorker(), $this->getWorkerMethod()]);
    }

    /**
     * @param int $threshold
     */
    public function setThreshold(int $threshold): void
    {
        $this->threshold = $threshold;
    }
}
