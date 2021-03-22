<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

interface ContainerInterface
{
    public function getWorkerBuilderFactory(): PrimaryActorName\Builder\FactoryInterface;
}
