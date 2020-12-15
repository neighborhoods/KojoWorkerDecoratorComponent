<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use LogicException;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\FactoryInterface as DecoratorFactoryInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

final class Builder implements BuilderInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;
    use Factory\AwareTrait;

    protected /*array*/ $decoratorFactories = [];

    public function build(): WorkerInterface
    {
        $connectionService = $this->getApiV1RDBMSConnectionService();
        $workerService = $this->getApiV1WorkerService();

        $worker = $this->getWorkerFactory()
            ->create();

        foreach ($this->decoratorFactories as $decoratorFactory) {
            $worker = $decoratorFactory
                ->create()
                ->setWorker($worker);
        }

        return $worker;
    }

    public function addFactory(DecoratorFactoryInterface $decoratorFactory): BuilderInterface
    {
        $factoryKey = str_replace('\\', '', get_class($decoratorFactory));
        if (isset($this->decoratorFactories[$factoryKey])) {
            throw new LogicException(sprintf('Factory with key, "%s", is already set.', $factoryKey));
        }
        $this->decoratorFactories[$factoryKey] = $decoratorFactory;

        return $this;
    }
}
