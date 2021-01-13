<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecoratorInterface;

interface FactoryInterface
{
    public function create(): UserlandPdoDecoratorInterface;
}
