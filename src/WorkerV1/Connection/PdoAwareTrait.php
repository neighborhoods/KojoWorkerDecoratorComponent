<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Connection;

use LogicException;
use PDO;

trait PdoAwareTrait
{
    /**
     * @var PDO
     */
    private $pdo;

    public function getPdo(): PDO
    {
        if ($this->pdo === null) {
            throw new LogicException('PDO is not set');
        }

        return $this->pdo;
    }

    public function setPdo(PDO $pdo): self
    {
        if (isset($this->pdo)) {
            throw new LogicException('PDO is already set');
        }
        $this->pdo = $pdo;

        return $this;
    }
}
