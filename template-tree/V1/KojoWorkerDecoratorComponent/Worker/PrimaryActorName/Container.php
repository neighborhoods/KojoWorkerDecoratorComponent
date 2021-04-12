<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler;
use Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName as Worker;
use Neighborhoods\Kojo\Api\V1;
use RuntimeException;
use Symfony\Component\DependencyInjection\Container as SymfonyContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class Container implements ContainerInterface
{
    private $wrappedContainer;

    private function buildWrappedContainer(): SymfonyContainer
    {
        $rootDirectory = realpath(dirname(__DIR__, 3));
        if (false === $rootDirectory) {
            throw new RuntimeException('Absolute path of the root directory not found.');
        }

        $cacheHandler = (new SymfonyConfigCacheHandler\Builder())
            ->setName(str_replace('\\', '', Worker::class))
            ->setCacheDirPath($rootDirectory . '/data/cache')
            ->setDebug(false)
            ->build();

        $container = (new TinyContainerBuilder())
            ->setContainerBuilder(new ContainerBuilder())
            ->setRootPath($rootDirectory)
            ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src')
            ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab')
            ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src')
            ->addSourcePath('fab/Prefab5/Doctrine')
            ->addSourcePath('fab/Prefab5/PDO')
            ->addSourcePath('fab/Prefab5/Opcache')
            ->addSourcePath(/**
             * @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\PrimaryActorName\Proxy.getContainer
             *
             * throw new \LogicException('Source path not updated. ' .
             *     'Add path to your component, e.g. src/WorkerComponentName.');
             */
            )
            ->addSourcePath(/**
             * @neighborhoods-buphalo:annotation-processor Neighborhoods\BuphaloTemplateTree\KojoWorker\PrimaryActorName\Proxy.getContainer
             *
             * throw new \LogicException('Fabrication path not updated. ' .
             *     'Add path to your component, e.g. fab/WorkerComponentName.');
             */
            )
            ->makePublic(Builder\FactoryInterface::class)
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass())
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass())
            ->setCacheHandler($cacheHandler)
            ->build();
        if ($container instanceof SymfonyContainer) {
            return $container;
        }
        throw new RuntimeException('Symfony container expected');
    }

    private function getWrappedContainer(): SymfonyContainer
    {
        if (!isset($this->wrappedContainer)) {
            $this->wrappedContainer = $this->buildWrappedContainer();
        }
        return $this->wrappedContainer;
    }

    public function getPrimaryActorNameBuilderFactory(
        V1\Worker\ServiceInterface $workerService,
        V1\RDBMS\Connection\ServiceInterface $connectionService
    ): Builder\FactoryInterface {
        $container = $this->getWrappedContainer();
        $container->set(V1\Worker\ServiceInterface::class . '.synthetic', $workerService);
        $container->set(V1\RDBMS\Connection\ServiceInterface::class . '.synthetic', $connectionService);
        /* @var Builder\FactoryInterface $builderFactory */
        $builderFactory = $container->get(Builder\FactoryInterface::class);
        return $builderFactory;
    }
}
