<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;

use Neighborhoods\Kojo\Api\V1;

trait DecoratorTrait
{
    use AwareTrait;
    use V1\Worker\Service\AwareTrait;
    use V1\RDBMS\Connection\Service\AwareTrait;

    private function runWorker(): self
    {
        $worker = $this->getWorkerDecorationV1Worker();

        // Run worker
        $worker->work();

        return $this;
    }
}
