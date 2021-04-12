<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use Worker\AwareTrait;

    public function build(): DecoratorInterface
    {
        $decorator = $this->getPrimaryActorNameFactory()
            ->create();

        $decorator->setWorker($this->getWorker());

        return $decorator;
    }
}
