<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use DateTime;
use Doctrine\DBAL\Connection;
use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use Neighborhoods\ThrowableDiagnosticComponent\ThrowableDiagnostic;
use OutOfBoundsException;
use Throwable;

final class ReschedulingDecorator implements ReschedulingDecoratorInterface
{
    use DecoratorTrait;
    use ThrowableDiagnostic\Builder\Factory\AwareTrait;

    public const MAX_RESCHEDULE_DELAY_SECONDS = 86400;// (24 hours)

    private /*int*/ $rescheduleDelaySeconds;
    private /*string*/ $jobTypeCode;
    private /*Connection*/ $connection;

    public function work(): WorkerInterface
    {
        $this->runWorker();

        if ($this->getApiV1WorkerService()->isRequestApplied()) {
            $this->getApiV1WorkerService()
                ->getLogger()
                ->warning('Kojo worker state request already applied, not rescheduling.');
        } else {
            sleep($this->getRescheduleDelaySeconds());

            $this->getConnection()->beginTransaction();
            try {
                $this->getApiV1WorkerService()
                    ->getNewJobScheduler()
                    ->setJobTypeCode($this->getJobTypeCode())
                    ->setWorkAtDateTime(new DateTime())
                    ->save();

                $this->getApiV1WorkerService()
                    ->requestCompleteSuccess()
                    ->applyRequest();

                $this->getConnection()->commit();
            } catch (Throwable $throwable) {
                $this->getConnection()->rollBack();
                $this->getThrowableDiagnosticBuilderFactory()
                    ->create()
                    ->build()
                    ->diagnose($throwable);
            }

            return $this;
        }

        return $this;
    }

    public function setRescheduleDelaySeconds(int $rescheduleDelaySeconds): ReschedulingDecoratorInterface
    {
        if (isset($this->rescheduleDelaySeconds)) {
            throw new LogicException('Reschedule Delay Seconds is already set.');
        }
        if ($rescheduleDelaySeconds < 0 || $rescheduleDelaySeconds > self::MAX_RESCHEDULE_DELAY_SECONDS) {
            throw new OutOfBoundsException('Reschedule Delay Seconds must be positive and at most ' .
                self::MAX_RESCHEDULE_DELAY_SECONDS);
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

    private function getConnection(): Connection
    {
        if (!isset($this->connection)) {
            throw new LogicException('Connection has not been set.');
        }
        return $this->connection;
    }

    public function setConnection(Connection $connection): ReschedulingDecoratorInterface
    {
        if (isset($this->connection)) {
            throw new LogicException('Connection is already set.');
        }
        $this->connection = $connection;
        return $this;
    }

    public function setJobTypeCode(string $jobTypeCode): ReschedulingDecoratorInterface
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
}
