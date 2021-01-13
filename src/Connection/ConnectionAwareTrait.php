<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Connection;

trait ConnectionAwareTrait
{
    /**
     * @var \PDO
     */
    private $connection;

    public function getConnection(): \PDO
    {
        if ($this->connection === null) {
            throw new \LogicException('Connection is not set');
        }

        return $this->connection;
    }

    public function setConnection(\PDO $connection): self
    {
        if (isset($this->connection)) {
            throw new \LogicException('Connection is already set');
        }
        $this->connection = $connection;

        return $this;
    }
}
