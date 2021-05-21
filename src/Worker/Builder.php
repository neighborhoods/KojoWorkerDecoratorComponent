<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use LogicException;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    protected /*array*/ $decoratorBuilderFactories = [];

    public function build(): WorkerInterface
    {
        $worker = $this->getWorkerFactory()
            ->create();

        foreach ($this->decoratorBuilderFactories as $decoratorBuilderFactory) {
            $worker = $decoratorBuilderFactory
                ->create()
                ->setWorker($worker)
                ->build();
        }

        return $worker;
    }

    public function addDecoratorBuilderFactory(
        Decorator\Builder\FactoryInterface $decoratorBuilderFactory
    ): BuilderInterface {
        $factoryKey = str_replace('\\', '', get_class($decoratorBuilderFactory));
        if (isset($this->decoratorBuilderFactories[$factoryKey])) {
            throw new LogicException(sprintf('Factory with key, "%s", is already set.', $factoryKey));
        }
        $this->decoratorBuilderFactories[$factoryKey] = $decoratorBuilderFactory;

        return $this;
    }
}
