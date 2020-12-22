<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName as Worker;
use Neighborhoods\ContainerBuilder\Builder;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use Psr\Container\ContainerInterface;
use RuntimeException;

class Proxy implements ProxyInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;

    public function work(): WorkerInterface
    {
        $worker = $this->getContainer()->get(Worker\Builder\FactoryInterface::class)
            ->create()
            ->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService())
            ->setApiV1WorkerService($this->getApiV1WorkerService())
            ->build();

        $worker->work();

        return $this;
    }

    protected function getContainer(): ContainerInterface
    {
        $containerBuilder = new Builder();
        $containerBuilder->setCanBuildZendExpressive(false);
        $containerBuilder->setContainerName(str_replace('\\', '', Worker::class));
        // Discover KojoWorkerDecoratorComponent service definitions
        $containerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter(
            '../vendor/neighborhoods/kojo-worker-decorator-component/fab'
        );
        $containerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter(
            '../vendor/neighborhoods/kojo-worker-decorator-component/src'
        );
        $containerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter(/**
         * @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\PrimaryActorName\Proxy.getContainer
         *
         * throw new \LogicException('Discoverable directory path filters not updated. ' .
         *     'Add path to your component, possibly prefab or vendors.');
         */
        );

        $rootDirectory = realpath(dirname(__DIR__, 3));
        if (false === $rootDirectory) {
            throw new RuntimeException('Absolute path of the root directory not found.');
        }
        $containerBuilder->getFilesystemProperties()->setRootDirectoryPath($rootDirectory);
        $containerBuilder->registerServiceAsPublic(Worker\Builder\FactoryInterface::class);
        return $containerBuilder->build();
    }
}
