<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

interface ContainerInterface
{
    public function getPrimaryActorNameBuilderFactory(): Builder\FactoryInterface;
}
