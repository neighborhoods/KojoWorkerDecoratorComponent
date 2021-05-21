<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\Kojo\Api\V1;

interface ContainerInterface
{
    public function getPrimaryActorNameBuilderFactory(
        V1\Worker\ServiceInterface $workerService,
        V1\RDBMS\Connection\ServiceInterface $connectionService
    ): Builder\FactoryInterface;
}
