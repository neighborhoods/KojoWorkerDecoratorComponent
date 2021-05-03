<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;

use LogicException;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

class Builder implements BuilderInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;
    use Factory\AwareTrait;

    protected /*array*/ $decoratorBuilderFactories = [];

    public function build(): WorkerInterface
    {
        $connectionService = $this->getApiV1RDBMSConnectionService();
        $workerService = $this->getApiV1WorkerService();

        $worker = $this->getWorkerDecorationV1WorkerFactory()
            ->create();

        $worker->setApiV1RDBMSConnectionService($connectionService);
        $worker->setApiV1WorkerService($workerService);

        foreach ($this->decoratorBuilderFactories as $decoratorBuilderFactory) {
            $worker = $decoratorBuilderFactory
                ->create()
                ->setWorkerDecorationV1Worker($worker)
                ->setApiV1RDBMSConnectionService($connectionService)
                ->setApiV1WorkerService($workerService)
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
