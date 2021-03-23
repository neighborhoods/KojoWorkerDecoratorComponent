<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Connection;

use Doctrine\DBAL\Connection;
use LogicException;

trait ConnectionAwareTrait
{
    /**
     * @var Connection
     */
    private $connection;

    public function getConnection(): Connection
    {
        if ($this->connection === null) {
            throw new LogicException('Connection is not set');
        }

        return $this->connection;
    }

    public function setConnection(Connection $connection): self
    {
        if (isset($this->connection)) {
            throw new LogicException('Connection is already set');
        }
        $this->connection = $connection;

        return $this;
    }
}
