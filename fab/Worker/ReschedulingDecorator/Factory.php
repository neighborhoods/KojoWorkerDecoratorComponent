<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ReschedulingDecoratorInterface
    {
        return clone $this->getWorkerReschedulingDecorator();
    }
}
