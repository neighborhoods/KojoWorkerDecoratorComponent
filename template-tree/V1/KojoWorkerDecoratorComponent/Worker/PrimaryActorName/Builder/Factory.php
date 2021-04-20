<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): Worker\BuilderInterface
    {
        return clone $this->getPrimaryActorNameBuilder();
    }
}
