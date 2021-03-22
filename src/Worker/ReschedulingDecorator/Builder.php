<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;

use LogicException;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker;

class Builder implements BuilderInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;
    use Factory\AwareTrait;
    use Worker\AwareTrait;

    private $prefabDoctrineDbalConnectionDecoratorRepository;
    private /*string*/ $connectionId;
    private /*string*/ $jobTypeCode;
    private /*int*/ $rescheduleDelaySeconds;

    public function build(): DecoratorInterface
    {
        $decorator = $this->getWorkerReschedulingDecoratorFactory()
            ->create();

        $connection = $this->getPrefabDoctrineDbalConnectionDecoratorRepository()
            ->getConnection($this->getConnectionId());

        $decorator->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService());
        $decorator->setApiV1WorkerService($this->getApiV1WorkerService());
        $decorator->setConnection($connection);
        $decorator->setJobTypeCode($this->getJobTypeCode());
        $decorator->setWorker($this->getWorker());
        $decorator->setRescheduleDelaySeconds($this->getRescheduleDelaySeconds());

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

    public function setJobTypeCode(string $jobTypeCode): BuilderInterface
    {
        if (isset($this->jobTypeCode)) {
            throw new LogicException('Job Type Code is already set.');
        }
        $this->jobTypeCode = $jobTypeCode;
        return $this;
    }

    private function getJobTypeCode(): string
    {
        if (!isset($this->jobTypeCode)) {
            throw new LogicException('Job Type Code has not been set.');
        }
        return $this->jobTypeCode;
    }

    public function setRescheduleDelaySeconds(int $rescheduleDelaySeconds): BuilderInterface
    {
        if (isset($this->rescheduleDelaySeconds)) {
            throw new LogicException('Reschedule Delay Seconds is already set.');
        }
        $this->rescheduleDelaySeconds = $rescheduleDelaySeconds;
        return $this;
    }

    private function getRescheduleDelaySeconds(): int
    {
        if (!isset($this->rescheduleDelaySeconds)) {
            throw new LogicException('Reschedule Delay Seconds has not been set.');
        }
        return $this->rescheduleDelaySeconds;
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
