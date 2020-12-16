<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

final class StatusLoggingDecorator implements StatusLoggingDecoratorInterface
{
    use DecoratorTrait {
        setApiV1WorkerService as private setDecoratorTraitApiV1WorkerService;
    }
    use WorkerService\Decorator\Factory\AwareTrait;

    public function work(): WorkerInterface
    {
        $this->runWorker();

        return $this;
    }

    public function setApiV1WorkerService(ServiceInterface $apiV1WorkerService): StatusLoggingDecoratorInterface
    {
        // Decorate worker service
        $decoratedApiV1WorkerService = $this->getKojoApiWorkerServiceDecoratorFactory()
            ->create()
            ->setApiV1WorkerService($apiV1WorkerService);

        return $this->setDecoratorTraitApiV1WorkerService($decoratedApiV1WorkerService);
    }
}
