<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecoratorInterface;

interface FactoryInterface
{
    public function create(): ReschedulingDecoratorInterface;
}
