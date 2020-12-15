<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
