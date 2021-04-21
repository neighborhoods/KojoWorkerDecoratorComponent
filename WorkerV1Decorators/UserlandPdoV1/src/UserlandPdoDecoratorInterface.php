<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\DecoratorInterface;
use PDO;

interface UserlandPdoDecoratorInterface extends DecoratorInterface
{
    public function setPdo(PDO $pdo);
}
