<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use PDO;

interface UserlandPdoDecoratorInterface extends DecoratorInterface
{
    public function setPdo(PDO $pdo);
}
