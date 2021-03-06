<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): WorkerInterface
    {
        return clone $this->getPrimaryActorName();
    }
}
