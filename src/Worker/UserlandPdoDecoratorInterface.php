<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Doctrine\DBAL\Connection;

interface UserlandPdoDecoratorInterface extends DecoratorInterface
{
    public function setConnection(Connection $connection);
}
