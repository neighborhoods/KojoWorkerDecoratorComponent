<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

trait DecoratorTrait
{
    use AwareTrait;

    private function runWorker(): self
    {
        $worker = $this->getWorker();

        // Run worker
        $worker->work();

        return $this;
    }
}
