<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Connection;

trait ConnectionAwareTrait
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * @param \PDO $connection
     */
    public function setConnection(\PDO $connection): void
    {
        $this->connection = $connection;
    }
}
