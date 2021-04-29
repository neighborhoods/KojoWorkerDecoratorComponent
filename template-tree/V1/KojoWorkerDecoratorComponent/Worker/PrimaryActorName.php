<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree;

use Neighborhoods\Kojo\Api\V1;

class PrimaryActorName implements PrimaryActorNameInterface
{
    use V1\Worker\Service\AwareTrait;
    use V1\RDBMS\Connection\Service\AwareTrait;

    public function work(): \Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface
    {
        /** @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\PrimaryActorName.work
        // TODO: Implement work() method.
        throw new \LogicException('Unimplemented custom worker.');
         */

        return $this;
    }
}
