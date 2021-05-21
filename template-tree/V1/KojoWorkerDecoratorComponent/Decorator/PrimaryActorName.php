<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

final class PrimaryActorName implements PrimaryActorNameInterface
{
    use Worker\AwareTrait;

    public function work(): WorkerInterface
    {
        /** @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\Decorator\PrimaryActorName.work
        // TODO: Implement work() method.
        throw new \LogicException('Unimplemented custom worker decorator.');
         */
        $this->getWorker()->work();

        return $this;
    }
}
