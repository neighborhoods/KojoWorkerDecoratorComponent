<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\DecoratorInterface;
use PDO;

interface UserlandPdoDecoratorInterface extends DecoratorInterface
{
    public function setPdo(PDO $pdo);
}
