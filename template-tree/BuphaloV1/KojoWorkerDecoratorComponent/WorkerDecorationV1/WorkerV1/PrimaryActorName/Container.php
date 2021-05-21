<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler;
use Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName as Worker;
use Neighborhoods\Kojo\Api;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Psr\Container\ContainerInterface as PsrContainerInterface;

final class Container implements ContainerInterface
{
    private const KOJO_WORKER_DECORATORS = [
        'WorkerDecorationV1Decorators/CrashedThresholdV1',
        'WorkerDecorationV1Decorators/ExceptionHandlingV1',
        // Uncomment ReschedulingV1 for observers
        // ReschedulingV1 requires ThrowableDiagnosticV1 and PostgresV1
        // 'WorkerDecorationV1Decorators/ReschedulingV1',
        'WorkerDecorationV1Decorators/RetryThresholdV1',
        'WorkerDecorationV1Decorators/UserlandPdoV1',
    ];
    private const THROWABLE_DIAGNOSTIC_COMPONENTS = [
        //'ThrowableDiagnosticV1',
        //'ThrowableDiagnosticV1Decorators/AwsS3V1',
        //'ThrowableDiagnosticV1Decorators/AwsSnsV1',
        //'ThrowableDiagnosticV1Decorators/AwsSqsV1',
        //'ThrowableDiagnosticV1Decorators/AwsV1',
        //'ThrowableDiagnosticV1Decorators/GuzzleV1',
        //'ThrowableDiagnosticV1Decorators/NestedDiagnosticV1',
        //'ThrowableDiagnosticV1Decorators/PostgresV1',
        //'ThrowableDiagnosticV1Decorators/Psr18V1',
        //'ThrowableDiagnosticV1Decorators/SymfonyHttpClientV1',
        //'ThrowableDiagnosticV1Decorators/TransientV1',
    ];

    private $wrappedContainer;

    private function buildWrappedContainer(): PsrContainerInterface
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

        if ($cacheHandler->hasInCache()) {
            return $cacheHandler->getFromCache();
        }

        $containerBuilder = (new TinyContainerBuilder())
            ->setContainerBuilder(new ContainerBuilder())
            ->setRootPath($rootDirectory)
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
            ->setCacheHandler($cacheHandler);

        foreach (self::KOJO_WORKER_DECORATORS as $decorator) {
            $containerBuilder
                ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab/' . $decorator)
                ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src/' . $decorator);
        }
        foreach (self::THROWABLE_DIAGNOSTIC_COMPONENTS as $component) {
            $containerBuilder
                ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/fab/' . $component)
                ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src/' . $component);
        }

        return $containerBuilder->build();
    }

    private function getWrappedContainer(): PsrContainerInterface
    {
        if (!isset($this->wrappedContainer)) {
            $this->wrappedContainer = $this->buildWrappedContainer();
        }
        return $this->wrappedContainer;
    }

    public function getPrimaryActorNameBuilderFactory(): Builder\FactoryInterface
    {
        return $this->getWrappedContainer()->get(Builder\FactoryInterface::class);
    }
}
