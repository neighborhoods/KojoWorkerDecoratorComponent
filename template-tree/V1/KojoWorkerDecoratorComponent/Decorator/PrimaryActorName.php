<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

final class PrimaryActorName implements PrimaryActorNameInterface
{
    use DecoratorTrait;

    public function work(): WorkerInterface
    {
        /** @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\Decorator\PrimaryActorName.work
        // TODO: Implement work() method.
        throw new \LogicException('Unimplemented custom worker decorator.');
         */
        $this->runWorker();

        return $this;
    }
}
