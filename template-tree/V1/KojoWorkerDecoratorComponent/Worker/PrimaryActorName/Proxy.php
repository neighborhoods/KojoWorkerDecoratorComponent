<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class Proxy implements ProxyInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;

    private $container;

    public function work(): WorkerInterface
    {
        $workerBuilderFactory = $this->getContainer()->getPrimaryActorNameBuilderFactory(
            $this->getApiV1WorkerService(),
            $this->getApiV1RDBMSConnectionService()
        );
        $worker = $workerBuilderFactory
            ->create()
            ->build();

        $worker->work();

        return $this;
    }

    protected function getContainer(): ContainerInterface
    {
        if (!isset($this->container)) {
            $this->container = new Container();
        }

        return $this->container;
    }
}
