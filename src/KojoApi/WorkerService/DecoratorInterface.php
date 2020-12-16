<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService;

use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;

interface DecoratorInterface extends ServiceInterface
{
    public function setApiV1WorkerService(ServiceInterface $apiV1WorkerService);
}
