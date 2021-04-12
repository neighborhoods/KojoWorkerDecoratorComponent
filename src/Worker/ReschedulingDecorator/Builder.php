<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;
    use Worker\AwareTrait;

    private $prefabDoctrineDbalConnectionDecoratorRepository;
    private /*string*/ $connectionId;

    public function build(): DecoratorInterface
    {
        $decorator = $this->getWorkerReschedulingDecoratorFactory()
            ->create();

        $connection = $this->getPrefabDoctrineDbalConnectionDecoratorRepository()
            ->getConnection($this->getConnectionId());
        $decorator->setPdo($connection->getWrappedConnection());
        $decorator->setWorker($this->getWorker());

        return $decorator;
    }

    public function setConnectionId(string $connectionId): BuilderInterface
    {
        if (isset($this->connectionId)) {
            throw new LogicException('Connection Id is already set.');
        }
        $this->connectionId = $connectionId;
        return $this;
    }

    private function getConnectionId(): string
    {
        if (!isset($this->connectionId)) {
            throw new LogicException('Connection Id has not been set.');
        }
        return $this->connectionId;
    }

    public function setPrefabDoctrineDbalConnectionDecoratorRepository(
        $prefabDoctrineDbalConnectionDecoratorRepository
    ): BuilderInterface {
        if (isset($this->prefabDoctrineDbalConnectionDecoratorRepository)) {
            throw new LogicException('Prefab Doctrine Dbal Connection Decorator Repository is already set.');
        }
        $this->prefabDoctrineDbalConnectionDecoratorRepository = $prefabDoctrineDbalConnectionDecoratorRepository;
        return $this;
    }

    private function getPrefabDoctrineDbalConnectionDecoratorRepository()
    {
        if (!isset($this->prefabDoctrineDbalConnectionDecoratorRepository)) {
            throw new LogicException('Prefab Doctrine Dbal Connection Decorator Repository has not been set.');
        }
        return $this->prefabDoctrineDbalConnectionDecoratorRepository;
    }
}
